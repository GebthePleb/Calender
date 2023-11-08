let nav = 0;
let clicked = null;
//try to parse a local file for events, if this fails then make an empty array
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : []; 
//get our calendar reference from the html file
const calendar = document.getElementById('calendar');

//this helps us to determine how to position the calendar 
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];


function load() {
  const date = new Date();

  //this is how the calendar changes
  if (nav !== 0) {
    date.setMonth(new Date().getMonth() + nav);
  }

  //These are method from the built in JS date objects
  const day = date.getDate();
  const month = date.getMonth();
  const year = date.getFullYear();

  const firstDayOfMonth = new Date(year, month, 1);
  //this is a clever way to get how many days are in the given month
  //We give the year and month+1, when passing 0 it is the last day of the previous month
  //then by calling get date we will get the last day of the given month. 
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  
  // passing it the us calendar
  const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
    weekday: 'long', //this is a way of editing the information we want from the function call
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  });
  // this outputs something like this : Friday, 2023 November 3
  //simple string manipulation to get out the day of the week
  const padding = weekdays.indexOf(dateString.split(', ')[0]);

  document.getElementById('monthDisplay').innerText = 
    `${date.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

  calendar.innerHTML = '';

  for(let i = 1; i <= padding + daysInMonth; i++) {
    // these are the squares used to represent the days
    const day = document.createElement('div');
    day.classList.add('day');

    const dayString = `${month + 1}/${i - padding}/${year}`;

    if (i > padding) {
      day.innerText = i - padding;
      const eventForDay = events.find(e => e.date === dayString);

      if (i - padding === day && nav === 0) {
        day.id = 'currentDay';
      }
      if (eventForDay) {
        //this is where I can add my events to the calendar
        continue
      }
    } else {
      day.classList.add('padding');
    }

    calendar.appendChild(day);    
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
