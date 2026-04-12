(function () { 
    /* variable assign for keyboard */ 
    var target = null, inputType, inputDivObj, sss_Info; 
    if (typeof (VK_INFO) != "undefined") { 
        sss_Info = VK_INFO; 
    } else { 
        sss_Info = 57456; 
    } 
    var sss_Enter = 13, sss_Left = 37, sss_Up = 38, sss_Right = 39, sss_Down = 40, sss_Back = 8, sss_Caps = 33, sss_Shift = 16; 
    //var smallArray = ['`', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-', '=', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j ', '[', ']', '\\', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', ';', '\'', '<<', '>>', 't', 'u', 'v', 'w', 'x', 'y', 'z', ',', '.', '/', 'ABC', 'Clear', 'Bksp', 'Space', 'Quit', 'Done'];
	var smallArray = ['`', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '-', '=', 'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p', '[', ']', '\\', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', ';', '\'', '<<', '>>', 'z', 'x', 'c', 'v', 'b', 'n', 'm', ',', '.', '/', 'ABC', 'Clear', 'Bksp', 'Space', 'Quit', 'Done'];
    var captialArray = ['~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', '{', '}', '\\', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', ':', '"', '<<', '>>', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '<', '>', '?', 'abc', 'Clear', 'Bksp', 'Space', 'Quit', 'Done'];
    //var keyboardvalue = ['192', '49', '50', '51', '52', '53', '54', '55', '56', '57', '48', '189', '187', '65', '66', '67', '68', '69', '70', '71', '72', '73', '74', '219', '221', '220', '75', '76', '77', '78', '79', '80', '81', '82', '83', '186', '222', '0000', '1111', '84', '85', '86', '87', '88', '89', '90', '188',  '190', '191', '33', '46', '8', '32', '27', '13'];
	var keyboardvalue = ['192', '49', '50', '51', '52', '53', '54', '55', '56', '57', '48', '189', '187', '81', '87', '69', '82', '84', '89', '85', '73', '79', '80', '219', '221', '220', '65', '83', '68', '70', '71', '72', '74', '75', '76', '186', '222', '0000', '1111', '90', '88', '67', '86', '66', '78', '77', '188',  '190', '191', '33', '46', '8', '32', '27', '13'];
    var captionAry = smallArray; 
    var divRow = 0, enterValue = 0, passwordValue = ""; 
    var ArrayLettersDiv = new Array(); 
    var initInfoCreate = false, initKeyBoardCreate = false, infoDisplay = false, keyboardDisplay = false, keyboardkey = false, othersType = false; 
 
    sss_js_generickeyboard = function () { 
        document.addEventListener("focus", function (e) {/* Event listener for focus event. */ 
            target = e.srcElement; 
            var content = target.contentEditable; 
            if (!target.readOnly) { 
                if (target.tagName.toLowerCase() == 'input') { 
                    inputType = target.type.toLowerCase(); 
                    if ((inputType == "text") || (inputType == "password") || (inputType == "email") || (inputType == "number") || (inputType == "color") || (inputType == "date") || (inputType == "datetime") || (inputType == "datetime-local") || (inputType == "khtml_isindex") || (inputType == "month") || (inputType == "tel") || (inputType == "search") || (inputType == "time") || (inputType == "url") || (inputType == "week")) {
                        othersType = false; 
                        if (!initInfoCreate) { sss_js_createInfoDiv(); } else { sss_js_infoDisplayInlineFunction(); } 
                    } else { 
                        target = null; 
                    } 
                } else if (target.tagName.toLowerCase() == "textarea") { 
                    othersType = false; 
                    if (!initInfoCreate) { sss_js_createInfoDiv(); } else { sss_js_infoDisplayInlineFunction(); } 
                } else if (content == "true") { 
                    othersType = true; 
                    if (!initInfoCreate) { sss_js_createInfoDiv(); } else { sss_js_infoDisplayInlineFunction(); } 
                } else { 
                    target = null; 
                } 
            } else { 
                target = null; 
            } 
 
        }, true); 
 
        document.addEventListener("blur", function (e) { /* Event listener for blur event. */ 
            if (target) { 
                e.preventDefault(); e.stopPropagation(); 
                sss_js_infoDisplayNoneFunction(); 
                if (keyboardDisplay) { sss_js_keyboardDisplayNoneFunction(); } 
                target = null; 
            } 
        }, true); 
 
        document.addEventListener("click", function (e) { /* Event listener for click event. */ 
            if (keyboardDisplay) { 
                if (e.srcElement.className != "sss_className") { 
                    e.preventDefault(); e.stopPropagation(); 
                } 
            } 
        }, true); 
 
        document.addEventListener("mousemove", function (e) { /* Event listener for mousemove event. */ 
            if (keyboardDisplay) { 
                if (e.srcElement.className != "sss_className") { 
                    e.preventDefault(); e.stopPropagation(); 
                } 
            } 
        }, true); 
 
        document.addEventListener("mousedown", function (e) { /* Event listener for mousedown event. */ 
            if (keyboardDisplay) { 
                e.preventDefault(); e.stopPropagation(); 
            } 
        }, true); 
 
        document.addEventListener("mouseover", function (e) { /* Event listener for mouseover event. */ 
            if (keyboardDisplay) { 
                e.preventDefault(); e.stopPropagation(); 
            } 
        }, true); 
 
        document.addEventListener("keyup", function (e) { /* Event listener for keyup event. */ 
            if (keyboardDisplay) { 
                e.preventDefault(); e.stopPropagation(); 
            } 
        }, true); 
 
        document.addEventListener("keypress", function (e) { /* Event listener for keypress event. */ 
            if (keyboardDisplay) { 
                e.preventDefault(); e.stopPropagation(); 
            } 
        }, true); 
 
 
        document.addEventListener("keydown", function (e) {/* Event listener for keydown event. */ 
            inputDivObj = document.getElementById("InputDiv"); 
            if (target) { 
                                if (e.keyCode == sss_Info || e.keyCode == 57456) { 
                    if (!keyboardDisplay) { 
                        e.preventDefault(); e.stopPropagation(); 
                        sss_js_infoDisplayNoneFunction(); 
                        sss_js_keyboardDisplayInlineFunction(); 
                    } else { 
                        e.preventDefault(); e.stopPropagation(); 
                        sss_js_keyboardDisplayNoneFunction(); 
                        sss_js_infoDisplayInlineFunction(); 
                    } 
                } 
                else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode == sss_Back) || (e.keyCode == 32) || (e.keyCode == sss_Caps) || (e.keyCode == 46) || (e.keyCode >= 186 && e.keyCode <= 192) || (e.keyCode >= 219 && e.keyCode <= 222)) {
                    if (!keyboardDisplay) { 
                        e.preventDefault(); e.stopPropagation(); 
                        sss_js_infoDisplayNoneFunction(); 
                        sss_js_keyboardDisplayInlineFunction(); 
                    } 
                } 
                if (keyboardDisplay) { 
                    e.preventDefault(); 
                    e.stopPropagation(); 
                    if (e.keyCode == sss_Enter) { 
                        if (!keyboardkey) { 
                            sss_js_functionClick(); 
                        } else { 
                            sss_js_DoneFunction(); 
                        } 
                    } else if (e.keyCode == sss_Left) { 
                        sss_js_leftArrowFunction(); keyboardkey = false; 
                    } else if (e.keyCode == sss_Right) { 
                        sss_js_rightArrowFunction(); keyboardkey = false; 
                    } else if (e.keyCode == sss_Up) { 
                        sss_js_upArrowFunction(); keyboardkey = false; 
                    } else if (e.keyCode == sss_Down) { 
                        sss_js_downArrowFunction(); keyboardkey = false; 
                    } else if (e.keyCode == sss_Shift) { 
                        sss_js_keyboardcaption_Swap(); keyboardkey = true; 
                    } else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode == sss_Back) || (e.keyCode == 32) || (e.keyCode == sss_Caps) || (e.keyCode == 46) || (e.keyCode >= 186 && e.keyCode <= 192) || (e.keyCode >= 219 && e.keyCode <= 222)) {
                        keyboardkey = true; 
                        sss_js_DivNonFocus(); 
                        for (i = 0; i < keyboardvalue.length; i++) { 
                            if (e.keyCode == keyboardvalue[i]) { 
                                enterValue = i; 
                            } 
                        } 
                        sss_js_functionClick(); 
                        sss_js_DivFocus(); 
                        sss_js_FocusValueAssign(); 
                    } 
                } 
            } else { 
                                if (e.keyCode == sss_Info || e.keyCode == 57456) { 
                    e.preventDefault(); 
                    e.stopPropagation(); 
                } 
            } 
        }, true); 
    } 
 
 
    sss_js_DivNonFocus = function () {/* Div Non-Focus style value*/ 
        ArrayLettersDiv[enterValue].setAttribute("style", sss_js_tdstyle_black); 
    } 
 
    sss_js_DivFocus = function () {/* Div Focus style value*/ 
        ArrayLettersDiv[enterValue].setAttribute("style", sss_js_tdstyle_orange); 
    } 
 
    sss_js_FocusValueAssign = function () {/* Assign focus value and Row value for div. */ 
        if (enterValue <= 12) { 
            divRow = 0; 
        } 
        else if ((enterValue >= 13) && (enterValue <= 25)) { 
            divRow = 1; 
        } 
        else if ((enterValue >= 26) && (enterValue <= 38)) { 
            divRow = 2; 
        } 
        else if ((enterValue >= 39) && (enterValue <= 49)) { 
            divRow = 3; 
        } 
        else if ((enterValue >= 50) && (enterValue <= 54)) { 
            divRow = 4; 
        } 
    } 
 
    sss_js_leftArrowFunction = function () { 
        switch (divRow) { 
            case 0: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 0 ? 12 : enterValue - 1; 
                sss_js_DivFocus(); 
                break; 
            case 1: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 13 ? 25 : enterValue - 1; 
                sss_js_DivFocus(); 
                break; 
            case 2: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 26 ? 38 : enterValue - 1; 
                sss_js_DivFocus(); 
                break; 
            case 3: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 39 ? 49 : enterValue - 1; 
                sss_js_DivFocus(); 
                break; 
            case 4: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 50 ? 54 : enterValue - 1; 
                sss_js_DivFocus(); 
                break; 
        } 
    } 
 
    sss_js_rightArrowFunction = function () { 
        switch (divRow) { 
            case 0: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 12 ? 0 : enterValue + 1; 
                sss_js_DivFocus(); 
                break; 
            case 1: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 25 ? 13 : enterValue + 1; 
                sss_js_DivFocus(); 
                break; 
            case 2: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 38 ? 26 : enterValue + 1; 
                sss_js_DivFocus(); 
                break; 
            case 3: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 49 ? 39 : enterValue + 1; 
                sss_js_DivFocus(); 
                break; 
            case 4: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue == 54 ? 50 : enterValue + 1; 
                sss_js_DivFocus(); 
                break; 
        } 
    } 
 
    sss_js_upArrowFunction = function () { 
        divRow == 0 ? divRow = 4 : divRow--; 
        switch (divRow) { 
            case 0: case 1: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue - 13; 
                sss_js_DivFocus(); 
                break; 
            case 2: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue > 48 ? 38 : enterValue - 13; 
                sss_js_DivFocus(); 
                break; 
            case 3: 
                sss_js_DivNonFocus(); 
                switch (enterValue) { 
                    case 50: enterValue = 39; break; 
                    case 51: enterValue = 41; break; 
                    case 52: enterValue = 43; break; 
                    case 53: enterValue = 48; break; 
                    case 54: enterValue = 49; break; 
                } 
                sss_js_DivFocus(); 
                break; 
            case 4: 
                sss_js_DivNonFocus(); 
                switch (enterValue) { 
                    case 0: case 1: enterValue = 50; break; 
                    case 2: case 3: enterValue = 51; break; 
                    case 4: case 5: case 6: case 7: case 8: enterValue = 52; break; 
                    case 9: case 10: enterValue = 53; break; 
                    case 11: case 12: enterValue = 54; break; 
                } 
                sss_js_DivFocus(); 
                break; 
        } 
    } 
 
    sss_js_downArrowFunction = function () { 
        divRow == 4 ? divRow = 0 : divRow++; 
        switch (divRow) { 
            case 0: 
                sss_js_DivNonFocus(); 
                switch (enterValue) { 
                    case 50: enterValue = 0; break; 
                    case 51: enterValue = 2; break; 
                    case 52: enterValue = 4; break; 
                    case 53: enterValue = 9; break; 
                    case 54: enterValue = 11; break; 
                } 
                sss_js_DivFocus(); 
                break; 
            case 1: case 2: 
                sss_js_DivNonFocus(); 
                enterValue = enterValue + 13; 
                sss_js_DivFocus(); 
                break; 
            case 3: 
 
                sss_js_DivNonFocus(); 
                enterValue = enterValue > 35 ? 49 : enterValue + 13; 
                sss_js_DivFocus(); 
                break; 
            case 4: 
                sss_js_DivNonFocus(); 
                switch (enterValue) { 
                    case 39: case 40: enterValue = 50; break; 
                    case 41: case 42: enterValue = 51; break; 
                    case 43: case 44: case 45: case 46: case 47: enterValue = 52; break; 
                    case 48: enterValue = 53; break; 
                    case 49: enterValue = 54; break; 
                } 
                sss_js_DivFocus(); 
                break; 
        } 
    } 
 
    sss_js_MouseOverFun = function (obj) {/*Mouse over function for focus and nonfocus.*/ 
        sss_js_DivNonFocus(); 
        var SplitenterValue = obj.split("_"); enterValue = parseInt(SplitenterValue[1]); 
        sss_js_DivFocus(); 
        sss_js_FocusValueAssign(); 
    } 
 
    sss_js_functionClick = function () {/*Click function*/ 
        switch (enterValue) { 
            case 54: 
                sss_js_DoneFunction(); 
                break; 
            case 53: 
                inputDivObj.value = "|"; passwordValue = ""; 
                target.focus(); 
                if (keyboardDisplay) { 
                    sss_js_keyboardDisplayNoneFunction(); 
                    sss_js_infoDisplayInlineFunction(); 
                    infoDisplay = true; 
                } 
 
                break; 
            case 52: 
                var insertIndex = inputDivObj.value.indexOf("|"); 
                if (insertIndex == inputDivObj.value.length - 1) { 
                    inputDivObj.value = inputDivObj.value.replace("|", ""); 
                    inputDivObj.value += " " + "|"; 
                } else { 
                    var insertValue = inputDivObj.value.split("|"); 
                    inputDivObj.value = insertValue[0] + " " + "|" + insertValue[1]; 
                } 
                break; 
            case 51: 
                sss_js_DeleteDivValue(); 
                break; 
            case 50: 
                inputDivObj.value = "|"; passwordValue = ""; 
                break; 
            case 49: 
                sss_js_keyboardcaption_Swap(); 
                break; 
 
            case 37: 
                sss_js_cursorBackwardFunction(); 
                break; 
 
            case 38: 
                sss_js_cursorForwardFunction(); 
                break; 
 
            default: 
                sss_js_InsertDivValue(); 
                break; 
        } 
 
    } 
 
    sss_js_keyboardcaption_Swap = function () {/*Swap the keyboard Text*/ 
        captionAry = (captionAry == smallArray) ? captialArray : smallArray; 
        for (i = 0; i < captionAry.length; i++) { 
            document.getElementById("LettersDiv_" + i).innerText = captionAry[i]; 
        } 
    } 
 
    sss_js_InsertDivValue = function () { /* Insert the text to Input Div */ 
        var insertIndex = inputDivObj.value.indexOf("|"); 
        if (insertIndex == inputDivObj.value.length - 1) { 
            inputDivObj.value = inputDivObj.value.replace("|", ""); 
            if (inputType == "password") { 
                inputDivObj.value += "*|"; 
                passwordValue += ArrayLettersDiv[enterValue].innerText; 
            } else { 
                inputDivObj.value += ArrayLettersDiv[enterValue].innerText + "|"; 
            } 
 
        } else { 
            var insertValue = inputDivObj.value.split("|"); 
            if (inputType == "password") { 
                inputDivObj.value = insertValue[0] + "*|" + insertValue[1]; 
                passwordValue = insertValue[0] + ArrayLettersDiv[enterValue].innerText + insertValue[1]; 
            } else { 
                inputDivObj.value = insertValue[0] + ArrayLettersDiv[enterValue].innerText + "|" + insertValue[1]; 
            } 
        } 
        inputDivObj.scrollLeft = inputDivObj.scrollWidth; 
    } 
 
    sss_js_DeleteDivValue = function () {/* Delete the text From Div */ 
        var Varlen = inputDivObj.value.length; 
        var backSpaceIndex = inputDivObj.value.indexOf("|"); 
        if (backSpaceIndex == Varlen - 1) { 
            if (Varlen > 1) { 
                inputDivObj.value = inputDivObj.value.substring(0, Varlen - 2); 
                inputDivObj.value = inputDivObj.value + "|"; 
                if (inputType == "password") { 
                    passwordValue = passwordValue.substring(0, passwordValue.length - 1); 
                } 
            } 
        } else { 
            var backSpaceValue = inputDivObj.value.split("|"); 
            if (inputType == "password") { 
                var aryValue_0 = passwordValue.substr(0, backSpaceValue[0].length); 
                var aryValue_1 = passwordValue.substr(backSpaceValue[0].length, backSpaceValue[1].length); 
                passwordValue = aryValue_0.substring(0, aryValue_0.length - 1) + aryValue_1; 
            } 
            inputDivObj.value = backSpaceValue[0].substring(0, backSpaceValue[0].length - 1) + "|" + backSpaceValue[1]; 
        } 
    } 
 
    sss_js_DoneFunction = function () {/*Send value to source Element and hide the Keyboard.*/ 
        if (inputType == "password") { 
            target.value = passwordValue; 
            target.focus(); 
            inputDivObj.value = "|"; passwordValue = ""; 
        } else { 
 
            if (othersType) { 
                target.innerText = inputDivObj.value.replace("|", ""); 
                target.focus(); 
                inputDivObj.value = "|"; passwordValue = ""; 
            } else { 
                target.value = inputDivObj.value.replace("|", ""); 
                target.focus(); 
                inputDivObj.value = "|"; passwordValue = ""; 
            } 
        } 
        if (keyboardDisplay) { 
            sss_js_keyboardDisplayNoneFunction(); 
            sss_js_infoDisplayInlineFunction(); 
            infoDisplay = true; 
        } 
    } 
 
    sss_js_cursorBackwardFunction = function () {/* Move cursor backward function */ 
        var backIndex = inputDivObj.value.indexOf("|"); 
        if (backIndex > 0) { 
            inputDivObj.value = inputDivObj.value.replace("|", ""); 
            var backValue = inputDivObj.value; 
            inputDivObj.value = ""; 
            for (i = 0; i < backValue.length; i++) { 
                if (i + 1 == backIndex) { 
                    inputDivObj.value += "|"; 
                    inputDivObj.scrollRight = inputDivObj.scrollWidth; 
                } 
                inputDivObj.value += backValue[i]; 
            } 
        } 
    } 
 
    sss_js_cursorForwardFunction = function () {/* Move cursor forward function */ 
        var forwardIndex = inputDivObj.value.indexOf("|"); 
        if (forwardIndex < inputDivObj.value.length - 1) { 
            inputDivObj.value = inputDivObj.value.replace("|", ""); 
            var forwardValue = inputDivObj.value; 
            inputDivObj.value = ""; 
            for (i = 0; i < forwardValue.length; i++) { 
                inputDivObj.value += forwardValue[i]; 
                if (i == forwardIndex) { 
                    inputDivObj.value += "|"; 
                    inputDivObj.scrollLeft = inputDivObj.scrollWidth; 
                } 
            } 
        } 
    } 
 
    sss_js_createInfoDiv = function () {/* Create Info Div */ 
        initInfoCreate = true; 
        var infoDiv = document.createElement("div"); 
        infoDiv.setAttribute("id", "sss_infokeyDiv"); 
        infoDiv.setAttribute("onmousedown", "return false;"); 
        infoDiv.setAttribute("style", "position:fixed !important; left:460px!important;top:550px!important;  background-color:#020303 !important;color:white !important;font-family:Sans-Serif !important; font-size:28px !important; border:2px solid #424141 !important;border-radius:5px !important;z-index:100001 !important;padding:5px !important;box-sizing: content-box !important;-webkit-box-sizing: content-box !important;");
        infoDiv.innerText = "Press INFO/Ctrl+i to open keypad"; 
        document.body.appendChild(infoDiv); 
    } 
 
    sss_js_infoDisplayInlineFunction = function () {/* Show Info Div */ 
        if (document.getElementById("sss_infokeyDiv") != null) { 
            document.getElementById("sss_infokeyDiv").style.display = "inline"; 
            infoDisplay = true; 
        } 
    } 
 
    sss_js_infoDisplayNoneFunction = function () {/* Hide Info Div */ 
        if (document.getElementById("sss_infokeyDiv") != null) { 
            document.getElementById("sss_infokeyDiv").style.display = "none"; 
            infoDisplay = false; 
        } 
    } 
 
    var sss_js_tdstyle_black = 'vertical-align:middle !important; background-color:Black !important;text-align:center !important; color:White !important; width:52px !important;height:45px !important;font-family:Sans-Serif !important; font-size:28px !important;cursor:pointer !important;';
    var sss_js_tdstyle_orange = 'vertical-align:middle !important; background-color:orange !important;text-align:center !important; color:black !important; width:52px !important;height:45px !important;font-family:Sans-Serif !important; font-size:28px !important;cursor:pointer !important;'
 
    sss_js_createKeyboard = function () {/* To create the UI For Display. */ 
        initKeyBoardCreate = true; 
        var rowlength = 13; 
        var startindex = 0, colspan = 2; 
        var table, tbody, tr, td, div; 
 
        table = document.createElement('table'); 
        table.setAttribute("id", "sss_KeyboardMainDiv"); 
        table.setAttribute("onmousedown", "return false"); 
        table.setAttribute('cellpadding', '5'); 
        table.setAttribute('cellspacing', '5'); 
        table.setAttribute('text-align', 'center !important;'); 
        table.setAttribute('style', 'position:fixed !important; z-index:100000 !important; background-color:#009bb2 !important;padding:5px !important;border-spacing:5px !important; border-collapse:separate !important; border:2px solid black!important;left:0px!important;top:0px!important;font-family:Sans-Serif !important; font-size:28px !important;box-sizing: content-box !important;-webkit-box-sizing: content-box !important;');
        tbody = document.createElement('tbody'); 
 
        iTr = document.createElement('tr'); 
        iTd = document.createElement('td'); 
        iTd.setAttribute('colspan', '13'); 
        iTr.appendChild(iTd); 
        tbody.appendChild(iTr); 
 
        var InputDiv = document.createElement("input"); 
        InputDiv.setAttribute("type", "text"); 
        InputDiv.setAttribute("id", "InputDiv"); 
        InputDiv.setAttribute("onmousedown", "return false"); 
        InputDiv.setAttribute("style", "background-color:#EBEBEB !important; width:100% !important;height:62px !important;padding:0px !important;font-size:28px !important;color:Black !important; overflow:auto !important; resize:none !important;border:2px solid black !important;box-sizing: content-box !important;-webkit-box-sizing: content-box !important;");
        iTd.appendChild(InputDiv); 
 
        for (i = 0; i < 5; i++) { 
            tr = document.createElement('tr'); 
            for (j = startindex; j < rowlength; j++) { 
                if (i == 4) { 
                    colspan = (captionAry[j] == "Space") ? 5 : 2; 
                    td = document.createElement('td'); 
                    td.setAttribute("id", "LettersDiv_" + j); 
                    td.setAttribute("class", "sss_className"); 
                    td.setAttribute("onmousemove", "sss_js_MouseOverFun(this.id)"); 
                    td.setAttribute("onclick", "sss_js_functionClick(this.id)"); 
                    td.appendChild(document.createTextNode(captionAry[j])); 
                    td.setAttribute('colspan', colspan); 
                    td.setAttribute('style', sss_js_tdstyle_black); 
                    tr.appendChild(td); 
                } else { 
                    if (captialArray[j] == "abc") { 
                        td = document.createElement('td'); 
                        td.setAttribute("id", "LettersDiv_" + j); 
                        td.setAttribute("class", "sss_className"); 
                        td.setAttribute("onmousemove", "sss_js_MouseOverFun(this.id)"); 
                        td.setAttribute("onclick", "sss_js_functionClick(this.id)"); 
                        td.appendChild(document.createTextNode(captionAry[j])); 
                        td.setAttribute('colspan', 3); 
                        td.setAttribute('style', sss_js_tdstyle_black); 
                        tr.appendChild(td); 
                        j = j + 2; 
                        rowlength = rowlength - 2; 
                    } else { 
                        td = document.createElement('td'); 
                        td.setAttribute("id", "LettersDiv_" + j); 
                        td.setAttribute("class", "sss_className"); 
                        td.setAttribute("onmousemove", "sss_js_MouseOverFun(this.id)"); 
                        td.setAttribute("onclick", "sss_js_functionClick(this.id)"); 
                        td.appendChild(document.createTextNode(captionAry[j])); 
                        td.setAttribute('style', sss_js_tdstyle_black); 
                        tr.appendChild(td); 
                    } 
                } 
 
            } 
            tbody.appendChild(tr); 
            startindex = rowlength; 
            rowlength = (i == 3) ? rowlength + 5 : rowlength + 13; 
        } 
        table.appendChild(tbody); 
        document.body.appendChild(table); 
 
        var aryLength = captionAry.length; 
        for (aryCount = 0; aryCount < aryLength; aryCount++) { 
            ArrayLettersDiv[aryCount] = document.getElementById("LettersDiv_" + aryCount); 
        } 
        ArrayLettersDiv[0].setAttribute("style", sss_js_tdstyle_orange); 
        sss_js_insertValuePasswordText(); 
        if (othersType) { 
            target.innerText = ""; 
        } else { 
            target.value = ""; 
        } 
    } 
 
    sss_js_keyboardDisplayInlineFunction = function () {/* Show Keyboard Div */ 
        if (!initKeyBoardCreate) { 
            sss_js_createKeyboard(); 
            keyboardDisplay = true; 
        } else { 
            sss_js_insertValuePasswordText(); 
            document.getElementById("sss_KeyboardMainDiv").style.display = "inline"; 
            keyboardDisplay = true; target.value = ""; target.innerText = ""; 
        } 
    } 
 
    sss_js_keyboardDisplayNoneFunction = function () {/* Hide Keyboard Div */ 
        document.getElementById("sss_KeyboardMainDiv").style.display = "none"; 
        keyboardDisplay = false; 
    } 
 
    sss_js_insertValuePasswordText = function () { 
        inputDivObj = document.getElementById("InputDiv"); 
        if (inputType == "password") { 
            inputDivObj.value = ""; 
            passwordValue = target.value; 
            for (i = 0; i < target.value.length; i++) { 
                inputDivObj.value += "*"; 
            } 
            inputDivObj.value += "|" 
 
        } else { 
            if (othersType) { 
                inputDivObj.value = target.innerText + "|"; 
            } 
            else { 
                inputDivObj.value = target.value + "|"; 
            } 
        } 
    } 
 
    if (location.href.search(/index_history/i) != -1) { 
                console.log("New Version for generic Keyboard Version 1.1 19OCT13"); 
    } else if (location.href.search("youtube.com/tv") != -1) { 
                console.log("New Version for generic Keyboard Version 1.1 19OCT13"); 
    } 
    else if (location.href.search("STB/index") != -1) { 
                console.log("New Version for generic Keyboard Version 1.1 19OCT13"); 
    } 
    else { 
                console.log("New Version for generic Keyboard Version 1.1 19OCT13"); 
        sss_js_generickeyboard(); 
    } 
})(); 