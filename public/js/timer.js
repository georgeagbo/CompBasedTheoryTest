document.addEventListener('DOMContentLoaded', function (event) {
  const timer = document.getElementById('timer')
  let timeSecond = 5000;

  let countDown = setInterval(function () {
    timeSecond--
    displayTime(timeSecond)
    if (timeSecond == 10) {
      timer.style.color = 'red'
    } else if (timeSecond == 0) {
      endTime()
      clearInterval(countDown)
    }
  }, 1000)

  function displayTime(timeSecond) {
    const min = Math.floor(timeSecond / 60)
    const sec = Math.floor(timeSecond % 60)
    timer.innerHTML = `${min < 10 ? '0' : ''} ${min} : ${
      sec < 10 ? '0' : ''
    } ${sec}`
  }
  function endTime() {
    document.body.innerHTML = window.location = '/test-timeout'
  }
  function submitTest() {
    document.body.innerHTML = window.location = '/test-submitted'
  }
  const submit = document.getElementById('submitExam');
  submit.addEventListener('click', function () {
    submitTest();
  });
})
