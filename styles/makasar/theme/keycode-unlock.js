var keyCodes = {
    /*Undefined Keys*/
    KEY_UNDEFINED: (typeof (VK_UNDEFINED) != "undefined") ? VK_UNDEFINED : 0,
    KEY_INFO: (typeof (VK_INFO) != "undefined") ? VK_INFO : 57456,
	KEY_tv: (typeof (VK_TV) != "undefined") ? VK_TV : 57555,
	KEY_vod: (typeof (VK_VOD) != "undefined") ? VK_VOD : 57434,
	KEY_fnb: (typeof (VK_FNB) != "undefined") ? VK_FNB : 57432,
	KEY_CHdown: (typeof (VK_CHDOWN) != "undefined") ? VK_CHDOWN : 428,
	KEY_CHup: (typeof (VK_CHUP) != "undefined") ? VK_CHUP : 427,

    /* Navigation Keys*/
    KEY_left: (typeof (VK_LEFT) != "undefined") ? VK_LEFT : 37,
    KEY_up: (typeof (VK_UP) != "undefined") ? VK_UP : 38,
    KEY_right: (typeof (VK_RIGHT) != "undefined") ? VK_RIGHT : 39,
    //KEY_down: (typeof (VK_DOWN) != "undefined") ? VK_DOWN : 40,
    KEY_enter: (typeof (VK_ENTER) != "undefined") ? VK_ENTER : 13,

    /* Video & Audio player keys */
    KEY_play: (typeof (VK_PLAY) != "undefined") ? VK_PLAY : 415,
    KEY_stop: (typeof (VK_STOP) != "undefined") ? VK_STOP : 413,
    KEY_rewind: (typeof (VK_REWIND) != "undefined") ? VK_REWIND : 412,
    KEY_fastFwd: (typeof (VK_FAST_FWD) != "undefined") ? VK_FAST_FWD : 417,

    /*color keys */
    KEY_red: (typeof (VK_RED) != "undefined") ? VK_RED : 403,
    KEY_green: (typeof (VK_GREEN) != "undefined") ? VK_GREEN : 404,
    //KEY_yellow: (typeof (VK_YELLOW) != "undefined") ? VK_YELLOW : 405,
    //KEY_blue: (typeof (VK_BLUE) != "undefined") ? VK_BLUE : 406,

    /* 0-9 Number keys */
    KEY_0: (typeof (VK_0) != "undefined") ? VK_0 : 48,
    KEY_1: (typeof (VK_1) != "undefined") ? VK_1 : 49,
    KEY_2: (typeof (VK_2) != "undefined") ? VK_2 : 50,
    KEY_3: (typeof (VK_3) != "undefined") ? VK_3 : 51,
    KEY_4: (typeof (VK_4) != "undefined") ? VK_4 : 52,
    KEY_5: (typeof (VK_5) != "undefined") ? VK_5 : 53,
    KEY_6: (typeof (VK_6) != "undefined") ? VK_6 : 54,
    KEY_7: (typeof (VK_7) != "undefined") ? VK_7 : 55,
    KEY_8: (typeof (VK_8) != "undefined") ? VK_8 : 56,
    KEY_9: (typeof (VK_9) != "undefined") ? VK_9 : 57,

    /* 0-9 Numericpad Keys */
    KEY_NUMPAD_0: (typeof (VK_NUMPAD0) != "undefined") ? VK_NUMPAD0 : 96,
    KEY_NUMPAD_1: (typeof (VK_NUMPAD1) != "undefined") ? VK_NUMPAD1 : 97,
    KEY_NUMPAD_2: (typeof (VK_NUMPAD2) != "undefined") ? VK_NUMPAD2 : 98,
    KEY_NUMPAD_3: (typeof (VK_NUMPAD3) != "undefined") ? VK_NUMPAD3 : 99,
    KEY_NUMPAD_4: (typeof (VK_NUMPAD4) != "undefined") ? VK_NUMPAD4 : 100,
    KEY_NUMPAD_5: (typeof (VK_NUMPAD5) != "undefined") ? VK_NUMPAD5 : 101,
    KEY_NUMPAD_6: (typeof (VK_NUMPAD6) != "undefined") ? VK_NUMPAD6 : 102,
    KEY_NUMPAD_7: (typeof (VK_NUMPAD7) != "undefined") ? VK_NUMPAD7 : 103,
    KEY_NUMPAD_8: (typeof (VK_NUMPAD8) != "undefined") ? VK_NUMPAD8 : 104,
    KEY_NUMPAD_9: (typeof (VK_NUMPAD9) != "undefined") ? VK_NUMPAD9 : 105,

    /* Arithmatic symboles Keys  */
    KEY_multiply: (typeof (VK_MULTIPLY) != "undefined") ? VK_MULTIPLY : 106,
    KEY_add: (typeof (VK_ADD) != "undefined") ? VK_ADD : 107,
    KEY_subtract: (typeof (VK_SUBTRACT) != "undefined") ? VK_SUBTRACT : 109,
    KEY_Divide: (typeof (VK_DIVIDE) != "undefined") ? VK_DIVIDE : 111,
    Key_separator: (typeof (VK_SEPARATOR) != "undefined") ? VK_SEPARATOR : 108,
    Key_decimal: (typeof (VK_DECIMAL) != "undefined") ? VK_DECIMAL : 110,

    /* A-Z Keys */
    KEY_A: (typeof (VK_A) != "undefined") ? VK_A : 65,
    KEY_B: (typeof (VK_B) != "undefined") ? VK_B : 66,
    KEY_C: (typeof (VK_C) != "undefined") ? VK_C : 67,
    KEY_D: (typeof (VK_D) != "undefined") ? VK_D : 68,
    KEY_E: (typeof (VK_E) != "undefined") ? VK_E : 69,
    KEY_F: (typeof (VK_F) != "undefined") ? VK_F : 70,
    KEY_G: (typeof (VK_G) != "undefined") ? VK_G : 71,
    KEY_H: (typeof (VK_H) != "undefined") ? VK_H : 72,
    KEY_I: (typeof (VK_I) != "undefined") ? VK_I : 73,
    KEY_J: (typeof (VK_J) != "undefined") ? VK_J : 74,
    KEY_K: (typeof (VK_K) != "undefined") ? VK_K : 75,
    KEY_L: (typeof (VK_L) != "undefined") ? VK_L : 73,
    KEY_M: (typeof (VK_M) != "undefined") ? VK_M : 77,
    KEY_N: (typeof (VK_N) != "undefined") ? VK_N : 78,
    KEY_O: (typeof (VK_O) != "undefined") ? VK_O : 79,
    KEY_P: (typeof (VK_P) != "undefined") ? VK_P : 80,
    KEY_Q: (typeof (VK_Q) != "undefined") ? VK_Q : 71,
    KEY_R: (typeof (VK_R) != "undefined") ? VK_R : 82,
    KEY_S: (typeof (VK_S) != "undefined") ? VK_S : 83,
    KEY_T: (typeof (VK_T) != "undefined") ? VK_T : 84,
    KEY_U: (typeof (VK_U) != "undefined") ? VK_U : 85,
    KEY_V: (typeof (VK_V) != "undefined") ? VK_V : 86,
    KEY_W: (typeof (VK_W) != "undefined") ? VK_W : 87,
    KEY_X: (typeof (VK_X) != "undefined") ? VK_X : 88,
    KEY_Y: (typeof (VK_Y) != "undefined") ? VK_Y : 89,
    KEY_Z: (typeof (VK_Z) != "undefined") ? VK_Z : 90,

    /*Controls Keys*/
    KEY_cancel: (typeof (VK_CANCEL) != "undefined") ? VK_CANCEL : 3,
    KEY_BackSpace: (typeof (VK_BACK_SPACE) != "undefined") ? VK_BACK_SPACE : 8,
    KEY_back: (typeof (VK_BACK) != "undefined") ? VK_BACK : 461,
    KEY_tab: (typeof (VK_TAB) != "undefined") ? VK_TAB : 9,
    KEY_clear: (typeof (VK_CLEAR) != "undefined") ? VK_CLEAR : 12,
    KEY_delete: (typeof (VK_DELETE) != "undefined") ? VK_DELETE : 46,
    KEY_shift: (typeof (VK_SHIFT) != "undefined") ? VK_SHIFT : 16,
    KEY_ctrl: (typeof (VK_CONTROL) != "undefined") ? VK_CONTROL : 17,
    KEY_alt: (typeof (VK_ALT) != "undefined") ? VK_ALT : 18,
    KEY_capsLock: (typeof (VK_CAPS_LOCK) != "undefined") ? VK_CAPS_LOCK : 20,
    KEY_exit: (typeof (VK_EXIT) != "undefined") ? VK_EXIT : 27,
    KEY_escape: (typeof (VK_ESCAPE) != "undefined") ? VK_ESCAPE : 27,
    KEY_space: (typeof (VK_SPACE) != "undefined") ? VK_SPACE : 32,
    KEY_pageUp: (typeof (VK_PAGE_UP) != "undefined") ? VK_PAGE_UP : 33,
    KEY_pageDown: (typeof (VK_PAGE_DOWN) != "undefined") ? VK_PAGE_DOWN : 34,
    KEY_end: (typeof (VK_END) != "undefined") ? VK_END : 35,
    KEY_home: (typeof (VK_HOME) != "undefined") ? VK_HOME : 36,
    KEY_numLock: (typeof (VK_NUM_LOCK) != "undefined") ? VK_NUM_LOCK : 144,
    KEY_scrollLock: (typeof (VK_SCROLL_LOCK) != "undefined") ? VK_SCROLL_LOCK : 145,
    KEY_backQuote: (typeof (VK_BACK_QUOTE) != "undefined") ? VK_BACK_QUOTE : 192,
    KEY_quote: (typeof (VK_QUOTE) != "undefined") ? VK_QUOTE : 222,

    /* F1-F12 Keys */
    KEY_F1: (typeof (VK_F1) != "undefined") ? VK_F1 : 112,
    KEY_F2: (typeof (VK_F2) != "undefined") ? VK_F2 : 113,
    KEY_F3: (typeof (VK_F3) != "undefined") ? VK_F3 : 114,
    KEY_F4: (typeof (VK_F4) != "undefined") ? VK_F4 : 115,
    KEY_F5: (typeof (VK_F5) != "undefined") ? VK_F5 : 116,
    KEY_F6: (typeof (VK_F6) != "undefined") ? VK_F6 : 117,
    KEY_F7: (typeof (VK_F7) != "undefined") ? VK_F7 : 118,
    KEY_F8: (typeof (VK_F8) != "undefined") ? VK_F8 : 119,
    KEY_F9: (typeof (VK_F9) != "undefined") ? VK_F9 : 120,
    KEY_F10: (typeof (VK_F10) != "undefined") ? VK_F10 : 121,
    KEY_F11: (typeof (VK_F11) != "undefined") ? VK_F11 : 122,
    KEY_F12: (typeof (VK_F2) != "undefined") ? VK_F12 : 123
};

var NUMERIC_KeyTable = {}
NUMERIC_KeyTable[keyCodes.KEY_0] = 0;
NUMERIC_KeyTable[keyCodes.KEY_1] = 1;
NUMERIC_KeyTable[keyCodes.KEY_2] = 2;
NUMERIC_KeyTable[keyCodes.KEY_3] = 3;
NUMERIC_KeyTable[keyCodes.KEY_4] = 4;
NUMERIC_KeyTable[keyCodes.KEY_5] = 5;
NUMERIC_KeyTable[keyCodes.KEY_6] = 6;
NUMERIC_KeyTable[keyCodes.KEY_7] = 7;
NUMERIC_KeyTable[keyCodes.KEY_8] = 8;
NUMERIC_KeyTable[keyCodes.KEY_9] = 9;