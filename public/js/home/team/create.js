/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 41);
/******/ })
/************************************************************************/
/******/ ({

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(42);


/***/ }),

/***/ 42:
/***/ (function(module, exports) {

var selectedGameId = 0;
var newMembersCount = 0;

$('select#game').change(function () {
    selectedGameId = this.value;
    newMembersCount = 0;

    $.ajax({
        method: "GET",
        url: window.location.origin + "/home/getGameRoles/" + selectedGameId,
        success: function success(gameRoles) {
            roles = gameRoles;

            $('#roles').html('');
        }
    });
});

$(document).on('click', ".new-member", function () {
    var _select$classList, _formCheckDiv$classLi;

    newMembersCount++;

    var formGroupDiv = document.createElement("div");
    formGroupDiv.classList.add("form-group");

    var select = document.createElement("select");
    select.name = "roles[" + newMembersCount + "][roleId]";
    (_select$classList = select.classList).add.apply(_select$classList, ["form-control", "mb-2"]);

    roles.forEach(function (role) {
        var option = document.createElement("option");
        option.value = role.id;
        option.text = role.label;
        select.append(option);
    });

    formGroupDiv.append(select);

    var input = document.createElement("input");
    input.classList.add("form-control");
    input.name = "roles[" + newMembersCount + "][username]";
    input.type = "text";

    formGroupDiv.append(input);

    var formCheckDiv = document.createElement("div");
    (_formCheckDiv$classLi = formCheckDiv.classList).add.apply(_formCheckDiv$classLi, ["form-check", "mt-2", "mb-3"]);

    var radio = document.createElement("input");
    radio.classList.add("form-check-input");
    radio.name = "roles[" + newMembersCount + "][admin]";
    radio.value = 1;
    radio.type = "checkbox";

    formCheckDiv.append(radio);

    var radioLabel = document.createElement("label");
    radioLabel.classList.add("form-check-label");
    radioLabel.setAttribute('for', "roles[" + newMembersCount + "][admin]");
    radioLabel.innerHTML = "En tant qu'administrateur";

    formCheckDiv.append(radioLabel);

    formGroupDiv.append(formCheckDiv);

    $("#roles").append(formGroupDiv);
});

/***/ })

/******/ });