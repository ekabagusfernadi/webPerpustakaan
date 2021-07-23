document.body.addEventListener("mouseover", function (e) {
  const xPos = Math.round((e.clientX / window.innerWidth) * 255);
  const yPos = Math.round((e.clientY / window.innerHeight) * 255);
  document.body.style.backgroundColor = "rgb(" + xPos + "," + yPos + " ,100)";
  document.body.style.color = "rgb(" + yPos + "," + xPos + " ,100)";
});
