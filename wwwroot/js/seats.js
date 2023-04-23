function select_seat(seat_num) {
  var seat = document.getElementsByClassName("seat")[seat_num - 1];

  if (seat.classList.contains("selected")) {
    available_seat.push(seat_num);
    seat.classList.remove("selected");
  } else {
    available_seat.splice(available_seat.indexOf(seat_num), 1);
    seat.classList.add("selected");
  }

  available_seat.sort(function (a, b) {
    return a - b;
  });
}
