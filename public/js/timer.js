let allocatedTime = document
  .getElementById('exam-duration')
  .getAttribute('data-title')
const timer = document.getElementById('timer')
let timeSecond = allocatedTime * 60;

let countDown = setInterval(function () {
  timeSecond--
  displayTime(timeSecond)
  if (timeSecond == 10) {
    timer.style.color = 'red'
  } else if (timeSecond == 0) {
    clearInterval(countDown)
    submitExam(data)
  }
}, 1000)

function displayTime(timeSecond) {
  const min = Math.floor(timeSecond / 60)
  const sec = Math.floor(timeSecond % 60)
  timer.innerHTML = `${min < 10 ? '0' : ''} ${min} : ${
    sec < 10 ? '0' : ''
  } ${sec}`
}
