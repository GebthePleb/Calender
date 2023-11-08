let nav = 0;
let clicked = null;
//try to parse a local file for events, if this fails then make an empty array
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : []; 
//get our calendar reference from the html file
const week = document.getElementById('week');

function startOfWeek(d)
  {
    d = new Date(d);
    var day = d.getDay(),
    diff = d.getDate() - day + (day == 0 ? -6:0); // adjust the day to sunday
    return new Date(d.setDate(diff));
  }

function endOfWeek(d)
  {
    d = new Date(d);
    var day = d.getDay(),
    diff = d.getDate() - day + (day == 0 ? -6:6); // adjust the day to saturday
    return new Date(d.setDate(diff));
  }

function getPrefix(d)
  {
    //this is needlessly complex because of the way we refer to numbers
    //if I just did dayValue % 10 it would make 11 the 11st and 12 the 12nd
    // and we just simply do not do that so I had to add exceptions for it.
    var dayValue = d.getDate();
    if (dayValue == 21) {return "st"}
    else if (dayValue == 31) {return "st"}
    else if (dayValue == 22) {return "nd"}
    else if (dayValue == 23) {return "rd"}
    else if (dayValue > 3) {return "th"}
    else if (dayValue == 3) {return "rd"}
    else if (dayValue == 2) {return "nd"}
    return "st"
  }


function load() {
  const date = new Date();
    console.log(nav)
  //These are method from the built in JS date objects
  const day = date.getDate();
  const dayOfWeek = date.getDay();
  const month = date.getMonth();
  const year = date.getFullYear();
 // this adjustment factor add's one weeks time in millieseconds so we can go back and forth through weeks
  const adjustment = nav * 6048e5
  const newdate = new Date(+new Date + adjustment);
  //I used this start of week and end of week to frame what days we are looking at. 
  const firstDayOfWeek = startOfWeek(new Date(newdate.getFullYear(), newdate.getMonth(), newdate.getDate()));
  const lastDayOfweek = endOfWeek(new Date(newdate.getFullYear(), newdate.getMonth(), newdate.getDate()));
  const firstDayEnd = getPrefix(firstDayOfWeek);
  const lastDayEnd = getPrefix(lastDayOfweek);

  document.getElementById('weekDisplay').innerText = 
  `${firstDayOfWeek.toLocaleDateString('en-us', { month: 'long' })} ${firstDayOfWeek.getDate()}${firstDayEnd} - ${lastDayOfweek.getDate()}${lastDayEnd} ${year}`;

  week.innerHTML = '';

  for(let i = 0; i <= 6; i++) {
    //creates a day box for each day of the week
    const tempDay = new Date(firstDayOfWeek.getFullYear(), firstDayOfWeek.getMonth(), firstDayOfWeek.getDate()+i);
    const day = document.createElement('div');
    day.classList.add('day');
    day.innerText = tempDay.getDate();

    if (tempDay.getDate() == date.getDate() && tempDay.getMonth() == date.getMonth()){
        day.id = 'currentDay';
    }

    week.appendChild(day);   
  }
}


function initButtons() {
  document.getElementById('nextButton').addEventListener('click', () => {
    nav++;
    load();
  });

  document.getElementById('backButton').addEventListener('click', () => {
    nav--;
    load();
  });
}

initButtons();
//as soon as the browser loads this file it will call this to load the calender 
load();
