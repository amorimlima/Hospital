'use strict';

var Curva = function (caminhos) {
	var self = this;

	this.paths = Array();
	
	this.setPath = function (x, y) {
		this.paths.push([x, y]);
	};
	this.getLength = function () {
		var length = 0;
		for (var i = 0; i < self.paths.length - 1; i++){
			length += pointDistance(self.paths[i], self.paths[i+1]);
		}
		return length;
	};
	this.getRelativePosition = function (relativeDistance) {
		var length = 0;
		var result = [0, 0]
		for (var i = 0; i < self.paths.length - 1; i++){
			var pointRelativePosition = length/self.getLength();
			var nextPointRelativePosition = (length + pointDistance(self.paths[i], self.paths[i+1]))/self.getLength();
			if (nextPointRelativePosition >= relativeDistance){
				result[0] = self.paths[i][0] + (self.paths[i+1][0] - self.paths[i][0]) * ((relativeDistance - pointRelativePosition)/(nextPointRelativePosition - pointRelativePosition));
				result[1] = self.paths[i][1] + (self.paths[i+1][1] - self.paths[i][1]) * ((relativeDistance - pointRelativePosition)/(nextPointRelativePosition - pointRelativePosition));
				break;
			}
			else{
				length += pointDistance(self.paths[i], self.paths[i+1]);
			}
		}
		return result;
	}

	switch(caminhos){
		case 1: 
			self.setPath(73, 120);
			self.setPath(73, 200);
			self.setPath(295, 200);
			self.setPath(295, 284);
			self.setPath(72, 284);
			self.setPath(72, 368);
			self.setPath(183, 368);
			self.setPath(183, 407);
			break;
		case 2: 
			self.setPath(73, 120);
			self.setPath(73, 200);
			self.setPath(295, 200);
			self.setPath(295, 284);
			self.setPath(72, 284);
			self.setPath(72, 368);
			self.setPath(183, 368);
			self.setPath(183, 407);
			break;
		case 3: 
			self.setPath(73, 120);
			self.setPath(73, 200);
			self.setPath(295, 200);
			self.setPath(295, 284);
			self.setPath(72, 284);
			self.setPath(72, 368);
			self.setPath(183, 368);
			self.setPath(183, 407);
			break;
		case 4: 
			self.setPath(73, 120);
			self.setPath(73, 200);
			self.setPath(295, 200);
			self.setPath(295, 284);
			self.setPath(72, 284);
			self.setPath(72, 368);
			self.setPath(183, 368);
			self.setPath(183, 407);
			break;
		case 5: 
			self.setPath(73, 120);
			self.setPath(73, 200);
			self.setPath(295, 200);
			self.setPath(295, 284);
			self.setPath(72, 284);
			self.setPath(72, 368);
			self.setPath(183, 368);
			self.setPath(183, 407);
			break;
		default:
			break;
	}
}

function pointDistance (p1, p2) {
	return Math.sqrt(Math.pow(p2[0] - p1[0], 2) + Math.pow(p2[1] - p1[1], 2));
}