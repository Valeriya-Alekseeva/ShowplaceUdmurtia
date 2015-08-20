module.exports = (function(){

	var prod = false;

	return {
		setEnv: function(newEnv) {
			prod = newEnv;
		},
		getEnv: function() {
			return prod;
		}
	}
}());