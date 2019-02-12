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
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
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
    var _formGroupDiv$classLi, _formInputsDiv$classL, _select$classList, _check$classList, _radio$classList, _close$classList;

    newMembersCount++;

    var formGroupDiv = document.createElement("div");
    (_formGroupDiv$classLi = formGroupDiv.classList).add.apply(_formGroupDiv$classLi, ["form-group", "d-flex"]);

    var formInputsDiv = document.createElement("div");
    (_formInputsDiv$classL = formInputsDiv.classList).add.apply(_formInputsDiv$classL, ["flex-column", "flex-fill"]);

    var select = document.createElement("select");
    select.name = "roles[" + newMembersCount + "][roleId]";
    (_select$classList = select.classList).add.apply(_select$classList, ["pointer", "form-control", "mb-2"]);

    roles.forEach(function (role) {
        var option = document.createElement("option");
        option.value = role.id;
        option.text = role.label;
        select.append(option);
    });

    formInputsDiv.append(select);

    var input = document.createElement("input");
    input.classList.add("form-control");
    input.name = "roles[" + newMembersCount + "][username]";
    input.type = "text";

    formInputsDiv.append(input);

    var check = document.createElement("div");
    (_check$classList = check.classList).add.apply(_check$classList, ["form-check", "mt-2", "mb-3"]);

    var radio = document.createElement("input");
    (_radio$classList = radio.classList).add.apply(_radio$classList, ["pointer", "form-check-input"]);
    radio.name = "roles[" + newMembersCount + "][admin]";
    radio.value = 1;
    radio.type = "checkbox";

    check.append(radio);

    var radioLabel = document.createElement("label");
    radioLabel.classList.add("form-check-label");
    radioLabel.setAttribute('for', "roles[" + newMembersCount + "][admin]");
    radioLabel.innerHTML = "En tant qu'administrateur";

    check.append(radioLabel);
    formInputsDiv.append(check);
    formGroupDiv.append(formInputsDiv);

    var close = document.createElement("i");
    (_close$classList = close.classList).add.apply(_close$classList, ["remove-role", "pointer", "fa", "fa-times", "ml-3"]);

    formGroupDiv.append(close);

    $("#roles").append(formGroupDiv);
});

$(document).on('click', ".remove-role", function () {
    $(this).parent().remove();
});

/***/ })

/******/ });