class Entry {
  constructor(pid,start,end,projects){
    this.pid = pid;
    this.start = start;
    this.end = end;
    this.day = Date.parse(start).toString("dddd");
    this.borough = getBorough(pid, projects);
  }
}

class DayCount {
  constructor(){
    this.Monday = 0;
    this.Tuesday = 0;
    this.Wednesday = 0;
    this.Thursday = 0;
    this.Friday = 0;
  }
  getMax(){
    return Math.max(this.Monday,this.Tuesday,this.Wednesday,this.Thursday,this.Friday);
  }
}

function getBorough(pid, projects){
  for (var i = 0; i<projects.length; i++){
    var project = projects[i];
    if (project['pid'] == pid){
      return project['borough'];
    }
  }
}

function generateCells(spe,rowSpan,monday,tuesday,wednesday,thursday,friday,projects){
  var m = 0;
  var tu = 0;
  var w = 0;
  var th = 0;
  var f = 0;
  for (var i = 0; i<spe.length; i++){
    if (spe[i].day == "Monday"){
      monday[m] = getTime(spe[i].start) + " - " + getTime(spe[i].end);
      m += 1;
    }else if (spe[i].day == "Tuesday"){
      tuesday[tu] = getTime(spe[i].start) + " - " + getTime(spe[i].end);
      tu += 1;
    }else if (spe[i].day == "Wednesday"){
      wednesday[w] = getTime(spe[i].start) + " - " + getTime(spe[i].end);
      w += 1;
    }else if (spe[i].day == "Thursday"){
      thursday[th] = getTime(spe[i].start) + " - " + getTime(spe[i].end);
      th += 1;
    }else if (spe[i].day == "Friday"){
      friday[f] = getTime(spe[i].start) + " - " + getTime(spe[i].end);
      f += 1;
    }
  }

  var ret = "";
  for (var i = 0; i < rowSpan; i++){
    ret+= "<tr class='text-center' style='background-color:"+getBGColor(spe[0].borough)+";'>";
    if (i == 0){
      console.log(spe[0].borough);
      ret+= "<th style='background-color:"+getBGColor(spe[0].borough)+";' class='align-middle text-center' rowspan='"+rowSpan+"'>"+ getProjectAddress(spe[0],projects)+"</th>";
    }
    ret+="<td>"+monday[i]+"</td><td>"+tuesday[i]+"</td><td>"+wednesday[i]+"</td><td>"+thursday[i]+"</td><td>"+friday[i]+"</td></tr>"
  }
  return ret;
}

function getBGColor(borough){
  if(borough == "The Bronx"){
    return "#80e5fc";
  }else if (borough == "Brooklyn"){
    return "#ffe270";
  }
  else if (borough == "Manhattan"){
    return "#f46666";
  }
  else if (borough == "Queens"){
    return "#aaf26f";
  }
  else if (borough == "Staten Island"){
    return "#e2aaff";
  }else{
    return "#ffffff";
  }
}

function getTextColor(borough){
  if(borough == "The Bronx"){
    return "#2c5b66";
  }else if (borough == "Brooklyn"){
    return "#7f6e2a";
  }
  else if (borough == "Manhattan"){
    return "#681f1f";
  }
  else if (borough == "Queens"){
    return "#3b5e1f";
  }
  else if (borough == "Staten Island"){
    return "#4b3159";
  }else{
    return "#000000";
  }
}

function getTime(datetime){
  return (Date.parse(datetime).toString("h:mm tt"));
}

function getProjectAddress(entry,projects){
  var pid = entry.pid;
  for (var i = 0; i<projects.length;i++){
    if (projects[i]['pid'] == pid){
      return projects[i]['address'];
    }
  }
}

function getEntries(timesheet, uid, projects){
  var entries = [];
  for(var i=0;i<timesheet.length;i++){
    var row = timesheet[i];
    if (row['uid'] == uid){
      entries.push(new Entry(row['pid'],row['starttime'],row['endtime'],projects));
    }
  }
  return entries;
}

function getSpecificProjectEntries(allEntries){
  var spe = []
  pid = allEntries[0].pid;
  for (var i=0; i<allEntries.length; i++){
    if (allEntries[i].pid == pid){
      spe.push(allEntries[i]);
      allEntries.splice(i,1);
      --i;
    }
  }
  return spe;
}

function getRowSpan(spe){
  dayCount = new DayCount();
  for (var i = 0;i<spe.length;i++){
    var day = spe[i].day;
    dayCount[day] += 1;
  }
  return dayCount.getMax();
}

function getPrettyDate(day){
  var ret = Date.parse(day).toString("M/d");
  return ret;
}

function fetchProjects(projects){
  return $.ajax({
      method: "POST",
      url: "controllers/fetch_projects.php",
      success: function(data){
          projects(JSON.parse(data));
      }
  });
};

function fetchTimesheet(timesheet){
  return $.ajax({
      method: "POST",
      url: "controllers/fetch_timesheet.php",
      success: function(data){
          timesheet(JSON.parse(data));
      }
  });
};

function populateTable(uid){
  fetchProjects(function(projects){
    fetchTimesheet(function(timesheet){
      var table = "<table class='table table-bordered'><thead class='thead-dark'><tr class='text-center'><th scope='col'></th><th scope='col'>Monday<br/>"+getPrettyDate('Monday')+"</th><th scope='col'>Tuesday<br/>"+getPrettyDate('Tuesday')+"</th><th scope='col'>Wednesday<br/>"+getPrettyDate('Wednesday')+"</th><th scope='col'>Thursday<br/>"+getPrettyDate('Thursday')+"</th><th scope='col'>Friday<br/>"+getPrettyDate('Friday')+"</th></tr></thead><tbody>";
        var allEntries = getEntries(timesheet, uid, projects);
        while(allEntries.length > 0){
          var spe = getSpecificProjectEntries(allEntries);
          var rowSpan = getRowSpan(spe);
          var monday = new Array(rowSpan).fill("");
          var tuesday = new Array(rowSpan).fill("");
          var wednesday = new Array(rowSpan).fill("");
          var thursday = new Array(rowSpan).fill("");
          var friday = new Array(rowSpan).fill("");
          var html = generateCells(spe,rowSpan,monday,tuesday,wednesday,thursday,friday,projects);
          table+=html;
        }
      table+="</tbody></table>";
      $('#timesheet').append(table);
    });
  });
};
