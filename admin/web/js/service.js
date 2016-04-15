function Api(urlService, secretKey, accessToken) {
    this.secretKey = secretKey;
    this.accessToken = accessToken;
    this.urlService = urlService;
}

Api.secretKey = null;
Api.accessToken = null;
Api.urlService = null;
Api.response = null;
Api.xhr = null;
/**
 * Это библиотечка js для нашего API
 *
 *
 * @returns {*}
 */
Api.prototype.getXHR = function () {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
};


Api.prototype.init = function (init) {
    this.secretKey = init.secretKey;
    this.accessToken = init.accessToken;
    this.urlService = init.urlService;
};


Api.prototype.execute = function (methodApi, option) {

    var xhr = this.getXHR();
    var form = new FormData();

    if (
        null == this.urlService
    )
        return false;

    var url = this.urlService + methodApi + '?';


    for (var variable in option) {
        if (option.hasOwnProperty(variable)) {
            url = url + variable + '=' + option[variable] + '&';
        }
    }

    if (
        null == this.secretKey ||
        null == this.accessToken
    )
        return false;


    xhr.open('POST', url, true);

    form.append('secretKey', this.secretKey);
    form.append('accessToken', this.accessToken);

    xhr.onreadystatechange = function(){
        Api.response = this.responseText
    };

    xhr.timeout = 200;
    xhr.send(form);

    return xhr;
};


(function($){

    function ServiceApi(urlService, secretKey, accessToken) {
        this.secretKey = secretKey;
        this.accessToken = accessToken;
        this.urlService = urlService;
    }

    ServiceApi.secretKey = null;
    ServiceApi.accessToken = null;
    ServiceApi.urlService = null;
    ServiceApi.response = null;
    ServiceApi.xhr = null;

    ServiceApi.error =  null;
    ServiceApi.beforeSend  = null;
    ServiceApi.complete =  null;
    ServiceApi.success =  null;

    ServiceApi.prototype.execute = function(methodApi, request){
        var form = new FormData();
        var option = {
            type: 'post',
            processData: false,
            contentType: false,
            dataType: "json"
        };

        if (
            null == this.urlService
        )
            return false;

        var url = this.urlService + methodApi + '?';

        for (var variable in request) {
            if (request.hasOwnProperty(variable)) {
                url = url + variable + '=' + request[variable] + '&';
            }
        }

        option.url = url;

        if (
            null == this.secretKey ||
            null == this.accessToken
        )
            return false;

        form.append('secretKey', this.secretKey);
        form.append('accessToken', this.accessToken);

        jQuery.ajax({
            type: 'post',
            url: url,
            processData: false,
            contentType: false,
            data: form,
            dataType: "json"
        })

    };

    jQuery.service = ServiceApi;




})(jQuery);



API = new Api('http://localhost/services/', 762812774, '6d801b541c51f2b02800e223b7e492bc');
/**
 * Сылки для каждой админки в разные каналы
 * также это делается для ботов
 *
 *
 *
 */

var response = API.execute(
    'link',
    {
        description: 'Украинцам нечего делать в евросоюзе',
        link: 'http://www.pravda.ru/news/world/formerussr/ukraine/08-04-2016/1297799-pangimun-0/',
        imgUrl: 'http://www.pravda.ru/image/article/6/7/2/342672.jpeg'
    }
);









