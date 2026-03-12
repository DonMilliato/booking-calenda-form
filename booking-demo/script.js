const bookingDate=document.getElementById('bookingDate'), 
selectedDate=document.getElementById('selectedDate'),
m=document.getElementById('bookingModal'),
t=document.getElementById('timeSelect'),
s=document.getElementById('staffSelect'),
sv=document.getElementById('serviceSelect'),
f=document.getElementById('bookingForm');

fetch('get_availability.php?type=services')
.then(r=>r.json())
.then(d=>d.forEach(x=>sv.innerHTML+=`<option value=${x.id}>${x.name}</option>`));

fetch('get_availability.php?type=staff')
.then(r=>r.json())
.then(d=>d.forEach(x=>s.innerHTML+=`<option value=${x.id}>${x.full_name}</option>`));

// d.onchange=()=>{
//  document.getElementById('selectedDate').value=d.value;
//  m.style.display='block';
bookingDate.onchange=()=>{
   selectedDate.value=bookingDate.value;
   m.style.display='block';

 fetch(`get_availability.php?type=times&date=${bookingDate.value}`)
 .then(r=>r.json())
 .then(x=>{
    t.innerHTML='';
    x.forEach(y=>t.innerHTML+=`<option>${y}</option>`)
 });
};

f.onsubmit=e=>{
 e.preventDefault();
 fetch('book.php',{method:'POST',body:new FormData(f)})
 .then(()=>alert('Booked'));
};