

function title(text) {

    if (!text) {
        return false;
    }

    var oldName = '小腿弹幕平台';
    var newName = text + '-' + oldName;

    $('.layui-logo').text(text);
    $("title").html(newName);
}

function setTab(className) {

    $('.layui-nav-item').each(function () {
        if ($(this).data('url') == className){
            $(this).addClass('layui-this');
        }

    });
}


/**
 * 获取系统时间
 * @returns {string}
 */
function getNowFormatDate(style) {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";

    // 判断时候 小于10
    var month = gtZero(date.getMonth() + 1 );
    var strDay = gtZero( date.getDate() );
    var Hours = gtZero( date.getHours() );
    var Minutes = gtZero( date.getMinutes() );

    var currentdate = '';
    currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDay + " " + Hours + seperator2 + Minutes;
    if (style =='day'){
        currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDay;
    }

    if (style == 'hour'){
        currentdate = Hours + seperator2 + Minutes;
    }

    return currentdate;
};

/**
 * 判断是否大于零
 */
function gtZero(num) {

    if (num >= 0 && num <= 9){
        num = "0" + num;
    }
    return num;
}

/**
 * 时间戳转时间
 * @param unixtimestamp
 * @returns {string}
 */
function timestampToDate (unixtimestamp){
    unixtimestamp = new Date(unixtimestamp*1000);
    var year = 1900 + unixtimestamp.getYear();
    var month = "0" + (unixtimestamp.getMonth() + 1);
    var date = "0" + unixtimestamp.getDate();
    var hour = "0" + unixtimestamp.getHours();
    var minute = "0" + unixtimestamp.getMinutes();
    var second = "0" + unixtimestamp.getSeconds();
    return year + "-" + month.substring(month.length-2, month.length)  + "-" + date.substring(date.length-2, date.length)
        + " " + hour.substring(hour.length-2, hour.length) + ":"
        + minute.substring(minute.length-2, minute.length) + ":"
        + second.substring(second.length-2, second.length);
}


/**
 * 绑定回车
 * @param key 要绑点的类
 * @param bind 绑定的类
 *
 */
function addKeyUp(key,bind) {

    $(key).keyup(function(event){
        if(event.keyCode ==13){
            $(bind).click();
        }
    });

}


/**
 * 转换为
 * @param s
 * @returns {string}
 */
function fmoney(s) {
    s = parseFloat((s + "").replace(/[^\d\.-]/g, ""))+ "";
    var l = s.split(".")[0].split("").reverse();
    t = "";
    for (i = 0; i < l.length; i++) {
        t += l[i] + ((i + 1) % 3 == 0 && (i + 1) != l.length ? "," : "");
    }
    return t.split("").reverse().join("");
}