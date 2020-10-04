document.getElementById("start").addEventListener("click" , () =>{
	document.getElementById("start").classList.remove("button");
	const bird = document.querySelector('.bird')
	const gameDisplay = document.querySelector('.game-container')
	const ground = document.querySelector('.ground')

	let birdLeft = 220
	let birdBottom = 100
	let gravity = 2.5
	var isGameOver = false
	let gap = 440

	function startGame(){
		birdBottom -= gravity
		bird.style.bottom = birdBottom + 'px'
		bird.style.left = birdLeft + 'px'
	}

	let gameTimerId = setInterval(startGame, 20)

	function control(e){
		if (e.keycode === 32){
			jump()
		}
	}

	function jump(){
		if (birdBottom < 480) {birdBottom += 50	}
		bird.style.bottom = birdBottom + 'px'
	}

	document.addEventListener('keyup', jump)
	document.addEventListener('click', jump)

	function generateObstacle(){
		let obstacleLeft = 500
		let randomHeight = Math.random() * 100
		let obstacleBottom = randomHeight
		const obstacle = document.createElement('div')
		const topObstacle = document.createElement('div')
		if (!isGameOver){
			obstacle.classList.add('obstacle')
			topObstacle.classList.add('topObstacle')
		}
		gameDisplay.appendChild(obstacle)
		gameDisplay.appendChild(topObstacle)
		obstacle.style.left = obstacleLeft + 'px'
		topObstacle.style.left = obstacle + 'px'
		obstacle.style.bottom = obstacleBottom + 'px'
		topObstacle.style.bottom = obstacleBottom + gap + 'px'

		function moveObstacle(){
			obstacleLeft -=2
			obstacle.style.left = obstacleLeft + 'px'
			topObstacle.style.left = obstacleLeft + 'px'

			if(obstacleLeft === -60){
				clearInterval(timerId)
				gameDisplay.removeChild(obstacle)
				gameDisplay.removeChild(topObstacle)
			}

			if(	
				obstacleLeft > 200 && obstacleLeft < 280 && birdLeft === 220 && (birdBottom < obstacleBottom + 153 || birdBottom > obstacleBottom + gap -200)||
				birdBottom === 0){
				gameOver()
				clearInterval(timerId)
				if(obstacleLeft > -60){
				clearInterval(timerId)
				gameDisplay.removeChild(obstacle)
				gameDisplay.removeChild(topObstacle)
				document.getElementById("start").classList.add("button");
			}
			}
		}
		let timerId = setInterval(moveObstacle, 20)
		if (!isGameOver) {setTimeout(generateObstacle, 3000)}
	}

	generateObstacle()
		let points = 0
function myTimer() {
	points++
	console.log(points)
document.getElementById("point").innerHTML = points;
}

var myVar = setInterval(myTimer,3000);

	function gameOver(){
		clearInterval(gameTimerId)
		isGameOver = true
		document.removeEventListener('keyup', jump)
		document.removeEventListener('click', jump)
		clearInterval(myVar);

	}
})