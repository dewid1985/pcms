/*
 * HTML5 Sortable jQuery Plugin
 * http://farhadi.ir/projects/html5sortable
 *
 * Copyright 2012, Ali Farhadi
 * Released under the MIT license.
 */
(function ($) {
    var dragging, placeholders = $();
    $.fn.sortable = function (options) {
        var method = String(options);
        options = $.extend({
            connectWith: false,
            drop: false,
        }, options);
        return this.each(function () {
            if (/^(enable|disable|destroy)$/.test(method)) {
                var items = $(this).children($(this).data('items')).attr('draggable', method == 'enable');
                if (method == 'destroy') {
                    items.add(this).removeData('connectWith items')
                        .off('dragstart.h5s dragend.h5s selectstart.h5s dragover.h5s dragenter.h5s drop.h5s');
                }
                return;
            }
            var isHandle, index, items = $(this).children(options.items);
            var placeholder = $('<' + (/^(ul|ol)$/i.test(this.tagName) ? 'li' : 'div') + ' class="sortable-placeholder">');
            items.find(options.handle).mousedown(function () {
                isHandle = true;
            }).mouseup(function () {
                isHandle = false;
            });
            $(this).data('items', options.items)
            placeholders = placeholders.add(placeholder);
            if (options.connectWith) {
                $(options.connectWith).add(this).data('connectWith', options.connectWith);
            }
            items.attr('draggable', 'true').on('dragstart.h5s', function (e) {
                if (options.handle && !isHandle) {
                    return false;
                }
                isHandle = false;
                var dt = e.originalEvent.dataTransfer;
                dt.effectAllowed = 'move';
                dt.setData('Text', 'dummy');
                index = (dragging = $(this)).addClass('sortable-dragging').index();
            }).on('dragend.h5s', function () {

                if (!dragging) {
                    return;
                }
                dragging.removeClass('sortable-dragging').show();
                placeholders.detach();
                if (index != dragging.index()) {
                    dragging.parent().trigger('sortupdate', {item: dragging});

                }

                dragging = null;
            }).not('a[href], img').on('selectstart.h5s', function () {
                this.dragDrop && this.dragDrop();
                return false;
            }).end().add([this, placeholder]).on('dragover.h5s dragenter.h5s drop.h5s', function (e) {
                if (!items.is(dragging) && options.connectWith !== $(dragging).parent().data('connectWith')) {
                    return true;
                }

                if (e.type == 'drop') {
                    e.stopPropagation();
                    if (typeof(options.drop) === "function") {
                        options.drop(dragging, placeholders);
                    } else {
                        placeholders.filter(':visible').after(dragging);
                        dragging.trigger('dragend.h5s');
                    }
                    return false;
                }
                e.preventDefault();
                e.originalEvent.dataTransfer.dropEffect = 'move';
                if (items.is(this)) {
                    if (options.forcePlaceholderSize) {
                        placeholder.height(dragging.outerHeight());
                    }
                    dragging.hide();
                    $(this)[placeholder.index() < $(this).index() ? 'after' : 'before'](placeholder);
                    placeholders.not(placeholder).detach();
                } else if (!placeholders.is(this) && !$(this).children(options.items).length) {
                    placeholders.detach();
                    $(this).append(placeholder);
                }
                return false;
            });
        });
    };
})(jQuery);


/**
 * id = _
 * class = -
 * name = camelCase
 */
(function (a) {
    function g(a, b) {
        var c = a.data("ddslick");
        var d = a.find(".dd-selected"), e = d.siblings(".dd-selected-value"), f = a.find(".dd-options"), g = d.siblings(".dd-pointer"), h = a.find(".dd-option").eq(b), k = h.closest("li"), l = c.settings, m = c.settings.data[b];
        a.find(".dd-option").removeClass("dd-option-selected");
        h.addClass("dd-option-selected");
        c.selectedIndex = b;
        c.selectedItem = k;
        c.selectedData = m;
        if (l.showSelectedHTML) {
            d.html((m.imageSrc ? '<img class="dd-selected-image' + (l.imagePosition == "right" ? " dd-image-right" : "") + '" src="' + m.imageSrc + '" />' : "") + (m.text ? '<label class="dd-selected-text">' + m.text + "</label>" : "") + (m.description ? '<small class="dd-selected-description dd-desc' + (l.truncateDescription ? " dd-selected-description-truncated" : "") + '" >' + m.description + "</small>" : ""))
        } else d.html(m.text);
        e.val(m.value);
        c.original.val(m.value);
        a.data("ddslick", c);
        i(a);
        j(a);
        if (typeof l.onSelected == "function") {
            l.onSelected.call(this, c)
        }
    }

    function h(b) {
        var c = b.find(".dd-select"), d = c.siblings(".dd-options"), e = c.find(".dd-pointer"), f = d.is(":visible");
        a(".dd-click-off-close").not(d).slideUp(50);
        a(".dd-pointer").removeClass("dd-pointer-up");
        if (f) {
            d.slideUp("fast");
            e.removeClass("dd-pointer-up")
        } else {
            d.slideDown("fast");
            e.addClass("dd-pointer-up")
        }
        k(b)
    }

    function i(a) {
        a.find(".dd-options").slideUp(50);
        a.find(".dd-pointer").removeClass("dd-pointer-up").removeClass("dd-pointer-up")
    }

    function j(a) {
        var b = a.find(".dd-select").css("height");
        var c = a.find(".dd-selected-description");
        var d = a.find(".dd-selected-image");
        if (c.length <= 0 && d.length > 0) {
            a.find(".dd-selected-text").css("lineHeight", b)
        }
    }

    function k(b) {
        b.find(".dd-option").each(function () {
            var c = a(this);
            var d = c.css("height");
            var e = c.find(".dd-option-description");
            var f = b.find(".dd-option-image");
            if (e.length <= 0 && f.length > 0) {
                c.find(".dd-option-text").css("lineHeight", d)
            }
        })
    }

    a.fn.ddslick = function (c) {
        if (b[c]) {
            return b[c].apply(this, Array.prototype.slice.call(arguments, 1))
        } else if (typeof c === "object" || !c) {
            return b.init.apply(this, arguments)
        } else {
            a.error("Method " + c + " does not exists.")
        }
    };
    var b = {}, c = {
        data: [],
        keepJSONItemsOnTop: false,
        width: 260,
        height: null,
        background: "#eee",
        selectText: "",
        defaultSelectedIndex: null,
        truncateDescription: true,
        imagePosition: "left",
        showSelectedHTML: true,
        clickOffToClose: true,
        onSelected: function () {
        }
    }, d = '<div class="dd-select"><input class="dd-selected-value" type="hidden" /><a class="dd-selected"></a><span class="dd-pointer dd-pointer-down"></span></div>', e = '<ul class="dd-options"></ul>', f = '<style id="css-ddslick" type="text/css">' + ".dd-select{ border-radius:2px; border:solid 1px #ccc; position:relative; cursor:pointer;}" + ".dd-desc { color:#aaa; display:block; overflow: hidden; font-weight:normal; line-height: 1.4em; }" + ".dd-selected{ overflow:hidden; display:block; padding:10px; font-weight:bold;}" + ".dd-pointer{ width:0; height:0; position:absolute; right:10px; top:50%; margin-top:-3px;}" + ".dd-pointer-down{ border:solid 5px transparent; border-top:solid 5px #000; }" + ".dd-pointer-up{border:solid 5px transparent !important; border-bottom:solid 5px #000 !important; margin-top:-8px;}" + ".dd-options{ border:solid 1px #ccc; border-top:none; list-style:none; box-shadow:0px 1px 5px #ddd; display:none; position:absolute; z-index:2000; margin:0; padding:0;background:#fff; overflow:auto;}" + ".dd-option{ padding:10px; display:block; border-bottom:solid 1px #ddd; overflow:hidden; text-decoration:none; color:#333; cursor:pointer;-webkit-transition: all 0.25s ease-in-out; -moz-transition: all 0.25s ease-in-out;-o-transition: all 0.25s ease-in-out;-ms-transition: all 0.25s ease-in-out; }" + ".dd-options > li:last-child > .dd-option{ border-bottom:none;}" + ".dd-option:hover{ background:#f3f3f3; color:#000;}" + ".dd-selected-description-truncated { text-overflow: ellipsis; white-space:nowrap; }" + ".dd-option-selected { background:#f6f6f6; }" + ".dd-option-image, .dd-selected-image { vertical-align:middle; float:left; margin-right:5px; max-width:64px;}" + ".dd-image-right { float:right; margin-right:15px; margin-left:5px;}" + ".dd-container{ position:relative;}​ .dd-selected-text { font-weight:bold}​</style>";
    if (a("#css-ddslick").length <= 0) {
        a(f).appendTo("head")
    }
    b.init = function (b) {
        var b = a.extend({}, c, b);
        return this.each(function () {
            var c = a(this), f = c.data("ddslick");
            if (!f) {
                var i = [], j = b.data;
                c.find("option").each(function () {
                    var b = a(this), c = b.data();
                    i.push({
                        text: a.trim(b.text()),
                        value: b.val(),
                        selected: b.is(":selected"),
                        description: c.description,
                        imageSrc: c.imagesrc
                    })
                });
                if (b.keepJSONItemsOnTop) a.merge(b.data, i); else b.data = a.merge(i, b.data);
                var k = c, l = a('<div id="' + c.attr("id") + '"></div>');
                c.replaceWith(l);
                c = l;
                c.addClass("dd-container").append(d).append(e);
                var i = c.find(".dd-select"), m = c.find(".dd-options");
                m.css({width: b.width});
                i.css({width: b.width, background: b.background});
                c.css({width: b.width});
                if (b.height != null) m.css({height: b.height, overflow: "auto"});
                a.each(b.data, function (a, c) {
                    if (c.selected) b.defaultSelectedIndex = a;
                    m.append("<li>" + '<a class="dd-option">' + (c.value ? ' <input class="dd-option-value" type="hidden" value="' + c.value + '" />' : "") + (c.imageSrc ? ' <img class="dd-option-image' + (b.imagePosition == "right" ? " dd-image-right" : "") + '" src="' + c.imageSrc + '" />' : "") + (c.text ? ' <label class="dd-option-text">' + c.text + "</label>" : "") + (c.description ? ' <small class="dd-option-description dd-desc">' + c.description + "</small>" : "") + "</a>" + "</li>")
                });
                var n = {settings: b, original: k, selectedIndex: -1, selectedItem: null, selectedData: null};
                c.data("ddslick", n);
                if (b.selectText.length > 0 && b.defaultSelectedIndex == null) {
                    c.find(".dd-selected").html(b.selectText)
                } else {
                    var o = b.defaultSelectedIndex != null && b.defaultSelectedIndex >= 0 && b.defaultSelectedIndex < b.data.length ? b.defaultSelectedIndex : 0;
                    g(c, o)
                }
                c.find(".dd-select").on("click.ddslick", function () {
                    h(c)
                });
                c.find(".dd-option").on("click.ddslick", function () {
                    g(c, a(this).closest("li").index())
                });
                if (b.clickOffToClose) {
                    m.addClass("dd-click-off-close");
                    c.on("click.ddslick", function (a) {
                        a.stopPropagation()
                    });
                    a("body").on("click", function () {
                        a(".dd-click-off-close").slideUp(50).siblings(".dd-select").find(".dd-pointer").removeClass("dd-pointer-up")
                    })
                }
            }
        })
    };
    b.select = function (b) {
        return this.each(function () {
            if (b.index) g(a(this), b.index)
        })
    };
    b.open = function () {
        return this.each(function () {
            var b = a(this), c = b.data("ddslick");
            if (c) h(b)
        })
    };
    b.close = function () {
        return this.each(function () {
            var b = a(this), c = b.data("ddslick");
            if (c) i(b)
        })
    };
    b.destroy = function () {
        return this.each(function () {
            var b = a(this), c = b.data("ddslick");
            if (c) {
                var d = c.original;
                b.removeData("ddslick").unbind(".ddslick").replaceWith(d)
            }
        })
    }
})(jQuery)

$(function () {
    $('#side-menu').metisMenu({
        //toggle: false
    });
});


$('.date').datetimepicker({
    format: 'Y-m-d H:i'
});

$.fn.exists = function () {
    return $(this).length;
};

$(function () {
    $(window).bind("load resize", function () {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100;
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });
});

tinyMCE.init({
    mode: "textareas",
    language: 'ru',
    editor_selector: "Editor",
    plugins: ['media', 'ImagePluginTechnomedia', 'ImageArticlePluginTechnomedia', 'print']
});

$('.form_datetime').datetimepicker({
    language: 'ru',
    weekStart: 1,
    todayBtn: 1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
    showMeridian: 1
});

var getBaseUrl = function () {
    return '//' + location.host + '/';
};

/***** ImagePluginTechnomedia ****/
tinymce.PluginManager.add('ImagePluginTechnomedia', function (editor) {

    function buildListItems(inputList, itemCallback, startItems) {
        function appendItems(values, output) {
            output = output || [];

            tinymce.each(values, function (item) {
                var menuItem = {text: item.text || item.title};

                if (item.menu) {
                    menuItem.menu = appendItems(item.menu);
                } else {
                    menuItem.value = item.value;
                    itemCallback(menuItem);
                }

                output.push(menuItem);
            });

            return output;
        }

        return appendItems(inputList, startItems || []);
    }

    function createImageList(callback) {
        return function () {
            var imageList = editor.settings.image_list;

            if (typeof imageList == "string") {
                tinymce.util.XHR.send({
                    url: imageList,
                    success: function (text) {
                        callback(tinymce.util.JSON.parse(text));
                    }
                });
            } else if (typeof imageList == "function") {
                imageList(callback);
            } else {
                callback(imageList);
            }
        };
    }

    function showDialog(imageList) {
        InsertImagesPlugin.init();
        $('#insert_images_in_materials').modal('show');
        $('#preview-list').on('click', '#insert_image', function () {
            var img = $($(this).parent()).children('img');
            onSubmitForm($(img).attr('src'));
            $('#insert_images_in_materials, #inserting-images-preview').modal('hide');
            $('#').modal('hide');
        });
        var win, data = {}, dom = editor.dom, imgElm = editor.selection.getNode();
        var width, height, imageListCtrl;

        function onSubmitForm(src) {
            /**Может пригодится **/
            data.alt = '';
            data.title = '';
            data.width = null;
            data.height = null;
            data.style = null;

            data = {
                src: src,
                alt: data.alt,
                title: data.title,
                width: data.width,
                height: data.height,
                style: data.style,
                "class": data["class"]
            };

            editor.undoManager.transact(function () {
                if (!data.src) {
                    if (imgElm) {
                        dom.remove(imgElm);
                        editor.focus();
                        editor.nodeChanged();
                    }

                    return;
                }

                if (data.title === "") {
                    data.title = null;
                }
                var id = $(imgElm).length + 1;
                if (!imgElm) {
                    data.id = id;
                    editor.focus();
                    editor.selection.setContent(dom.createHTML('img', data));
                    imgElm = dom.get(id);
                    dom.setAttrib(imgElm, id, null);
                } else {
                    dom.setAttribs(imgElm, data);
                }

            });
        }

        width = dom.getAttrib(imgElm, 'width');
        height = dom.getAttrib(imgElm, 'height');

        if (imgElm.nodeName == 'IMG' && !imgElm.getAttribute('data-mce-object') && !imgElm.getAttribute('data-mce-placeholder')) {
            data = {
                src: dom.getAttrib(imgElm, 'src'),
                alt: dom.getAttrib(imgElm, 'alt'),
                title: dom.getAttrib(imgElm, 'title'),
                "class": dom.getAttrib(imgElm, 'class'),
                width: width,
                height: height
            };
        } else {
            imgElm = null;
        }

        if (imageList) {
            imageListCtrl = {
                type: 'listbox',
                label: 'Image list',
                values: buildListItems(
                    imageList,
                    function (item) {
                        item.value = editor.convertURL(item.value || item.url, 'src');
                    },
                    [{text: 'None', value: ''}]
                ),
                value: data.src && editor.convertURL(data.src, 'src'),
                onselect: function (e) {
                    var altCtrl = win.find('#alt');

                    if (!altCtrl.value() || (e.lastControl && altCtrl.value() == e.lastControl.text())) {
                        altCtrl.value(e.control.text());
                    }

                    win.find('#src').value(e.control.value()).fire('change');
                },
                onPostRender: function () {
                    imageListCtrl = this;
                }
            };
        }
    }

    editor.addButton('image', {
        icon: 'image',
        tooltip: 'Вставить изображение из каталога',
        onclick: createImageList(showDialog),
        stateSelector: 'img:not([data-mce-object],[data-mce-placeholder])'
    });

    editor.addMenuItem('image', {
        icon: 'image',
        text: 'Вставить изображение из каталога',
        onclick: createImageList(showDialog),
        context: 'insert',
        prependToContext: true
    });

    //  editor.addCommand('mceImage', createImageList(showDialog));
});
/***** end ImagePluginTechnomedia ****/

tinymce.PluginManager.add('ImageArticlePluginTechnomedia', function (editor) {

    function showDialogUploadImage() {
        $('#upload-and-paste-images-in-materials').modal('show');

    }

    function init(callback) {
        return function () {
            var imageList = editor.settings.image_list;

            if (typeof imageList == "string") {
                tinymce.util.XHR.send({
                    url: imageList,
                    success: function (text) {
                        callback(tinymce.util.JSON.parse(text));
                    }
                });
            } else if (typeof imageList == "function") {
                imageList(callback);
            } else {
                callback(imageList);
            }
        };
    }

    editor.addMenuItem('imagearicle', {
        icon: 'paste',
        text: 'Загрузить изображение',
        onclick: init(showDialogUploadImage),
        context: 'insert',
        prependToContext: true
    })
});
/**articles**/
/**********************************************************************************************************************/

var Articles = {
    url: getBaseUrl() + 'articles/',
    table: $('#articles').dataTable(
        {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
            },
            "bFilter": false,
            "processing": true,
            "serverSide": true,
            "bSort": false,
            "ajax": {
                "url": "list",
                "data": function (requestDataModifiedGET) {
                    delete requestDataModifiedGET.columns;
                    delete requestDataModifiedGET.order;
                    requestDataModifiedGET.title = $('#title').val();
                    requestDataModifiedGET.anons = $('#anons').val();
                    requestDataModifiedGET.text = $('#text').val();
                    requestDataModifiedGET.of_created_at = $('#of_created_at').val();
                    requestDataModifiedGET.to_created_at = $('#to_created_at').val();
                    requestDataModifiedGET.of_modified_at = $('#of_modified_at').val();
                    requestDataModifiedGET.to_modified_at = $('#to_modified_at').val();
                    requestDataModifiedGET.to_published_at = $('#to_published_at').val();
                    requestDataModifiedGET.of_published_at = $('#of_published_at').val();
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "title"},
                {"data": "author"},
                {"data": "created_at"},
                {"data": "modified_at"},
                {"data": "published_at"},
                {
                    "data": null,
                    "class": "center",
                    "defaultContent": "<button class='btn btn-default btn-circle' type='button'>" +
                    "<i class='glyphicon glyphicon-pencil'></i>" +
                    "</button>"
                }
            ]
        }
    ),
    init: function () {
        $('#articles tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected');
        });

        $('#articles tbody').on('click', 'button', function () {
            localStorage.setItem('articleId', Articles.table.api().row($(this).parents('tr')).data().id);
            $(location).attr('href', Articles.url + 'editor');
        });

        $('#article_save').click(function () {
            $(':button,  :input, #article_save').attr('disabled', true);
            tinyMCE.get('text').getBody().setAttribute('contenteditable', false);
            Articles.saveDialog($().technomedia.saveArticleDialog);
        });


        $('#article').on('click', '#insert-img', function () {
            InsertImagesPlugin.init();
            $('#insert_images_in_materials').modal('show');
            localStorage.setItem('field-image-id', $(this).parent().parent().children('input').attr('id'));
            Articles.insertImgToInput()

        });
        $('#article').on('click', '#preview-image', function () {
            InsertImagesPlugin.init();
            $('#inserting-show-image').modal('show');
            $('#show_image').attr('src', $(this).parent().parent().children('input').val());
        });

        if (!!localStorage.getItem('articleId'))
            this.get();
    },
    reloadTable: function () {
        this.table.api().ajax.reload();
    },
    insertImgToInput: function () {
        $('#preview-list').on('click', '#insert_image', function () {
            $('#' + localStorage.getItem('field-image-id')).val($(this).parent().children('img').attr('src'));
            $('#insert_images_in_materials, #inserting-images-preview').modal('hide');
            localStorage.removeItem('field-image-id');
        });
    },
    get: function () {
        var articleId = localStorage.getItem('articleId');
        localStorage.removeItem('articleId');
        $.ajax({
            type: "post",
            url: Articles.url + 'get/' + articleId + '/json',
            error: function () {
                Articles.setMessageTpl($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (json) {
                json = $.parseJSON(json);
                tinymce.get('text').setContent(json.data.text);
                $.each(json.data, function (k, v) {
                    if (k == 'rubrics') {
                        Articles.setRubricsTpl(v);
                    } else {
                        $('#' + k).val(v);
                    }
                })
            }
        });
    },
    autoSave: function () {
        $.ajax({
            type: "post",
            url: Articles.url + 'auto-save/json',
            data: $('#article').serialize() + '&text=' + tinyMCE.get('text').getContent(),
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (data) {
                data = $.parseJSON(data);
                if (false === data.success) {
                    Articles.setErrorForm(data.errors);
                } else {
                    $(':button,  :input, #article_save').attr('disabled', true);
                    tinyMCE.get('text').getBody().setAttribute('contenteditable', false);
                    Articles.addArticlesMessageOk();
                }
            }
        });
    },
    add: function () {
        $.noty.closeAll();
        $(':button,  :input, #article_save').attr('disabled', false);
        tinyMCE.get('text').getBody().setAttribute('contenteditable', true);
        $.ajax({
            type: "post",
            url: Articles.url + 'add/json',
            data: $('#article').serialize() + '&text=' + tinyMCE.get('text').getContent(),
            error: function () {
                Articles.setMessageTpl($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (data) {
                data = $.parseJSON(data);
                if (false === data.success) {
                    Articles.setErrorForm(data.errors);
                } else {
                    $(':button,  :input, #article_save').attr('disabled', true);
                    tinyMCE.get('text').getBody().setAttribute('contenteditable', false);
                    Articles.addArticlesMessageOk();
                }
            }
        });

    },
    setErrorForm: function (errors) {
        $.noty.closeAll();
        $.each(errors, function (k, v) {
            $('#' + k + '_warning').noty({
                text: '<i class="glyphicon glyphicon-exclamation-sign"></i> ' + v,
                type: 'warning',
                dismissQueue: true,
                layout: 'topCenter',
                theme: 'defaultTheme',
                maxVisible: 30
            });
        })
    },
    saveDialog: function (message) {
        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-primary',
                    text: $().technomedia.btnSaveOk,
                    onClick: function (noty) {
                        noty.close();
                        Articles.add();
                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnSaveCancel,
                    onClick: function (noty) {
                        noty.close();
                        $(':button,  :input, #article_save').attr('disabled', false);
                        tinyMCE.get('text').getBody().setAttribute('contenteditable', true);
                    }
                }
            ]
        });
    },
    addArticlesMessageOk: function () {
        noty({
            text: $().technomedia.addArticlesMessageOk,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-primary',
                    text: $().technomedia.addArticlesMessageOkBtnList,
                    onClick: function () {
                        $(location).attr("href", Articles.url);
                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.addArticlesMessageOkBtnNew,
                    onClick: function () {
                        $(location).attr("href", Articles.url + 'editor');
                    }
                }
            ]
        });
    },
    setMessageTpl: function (message) {
        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            modal: true,
            buttons: [
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnClose,
                    onClick: function (noty) {
                        noty.close();
                    }
                }
            ]
        });
    },
    setRubricsTpl: function (rubrics) {
        var selectedDivRubric = $("#rubric");
        $.each(rubrics, function (k, v) {
            selectedDivRubric.append(
                '<button data-id="' + v.name + '" class="btn btn-default btn-xs" style="margin-right: 3px" ' +
                'type="button">' + v.short_name + ' ×</button>' +
                '<input id="rubric_' + v.name + '" hidden=""  data-id="' + v.name + '" name="' +
                k + '" value="' + v.name + '">'
            );
        });
    }
};


/**news**/
/**********************************************************************************************************************/

var News = {
    url: getBaseUrl() + 'news/',
    table: $('#news').dataTable(
        {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
            },
            "bFilter": false,
            "processing": true,
            "serverSide": true,
            "bSort": false,
            "ajax": {
                "url": "list",
                "data": function (requestDataModifiedGET) {
                    delete requestDataModifiedGET.columns;
                    delete requestDataModifiedGET.order;
                    requestDataModifiedGET.title = $('#title').val();
                    requestDataModifiedGET.anons = $('#anons').val();
                    requestDataModifiedGET.text = $('#text').val();
                    requestDataModifiedGET.of_created_at = $('#of_created_at').val();
                    requestDataModifiedGET.to_created_at = $('#to_created_at').val();
                    requestDataModifiedGET.of_modified_at = $('#of_modified_at').val();
                    requestDataModifiedGET.to_modified_at = $('#to_modified_at').val();
                    requestDataModifiedGET.to_published_at = $('#to_published_at').val();
                    requestDataModifiedGET.of_published_at = $('#of_published_at').val();
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "title"},
                {"data": "created_at"},
                {"data": "modified_at"},
                {"data": "published_at"},
                {
                    "data": null,
                    "class": "center",
                    "defaultContent": "<button class='btn btn-default btn-circle' type='button'>" +
                    "<i class='glyphicon glyphicon-pencil'></i>" +
                    "</button>"
                }
            ]
        }
    ), init: function () {
        $('#news tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected');
        });

        $('#news tbody').on('click', 'button', function () {
            localStorage.setItem('newsId', News.table.api().row($(this).parents('tr')).data().id);
            $(location).attr('href', News.url + 'editor');
        });

        $('#noun_save').click(function () {
            $(':button,  :input, #noun_save').attr('disabled', true);
            tinyMCE.get('text').getBody().setAttribute('contenteditable', false);
            News.saveDialog($().technomedia.saveNewsDialog);
        });

        $('#search_news').click(function () {
            News.reloadTable();
        });

        if (!!localStorage.getItem('newsId'))
            this.get();
    },
    reloadTable: function () {
        this.table.api().ajax.reload();
    },
    get: function () {
        var newsId = localStorage.getItem('newsId');
        localStorage.removeItem('newsId');
        $.ajax({
            type: "post",
            url: News.url + 'get/' + newsId + '/json',
            error: function () {
                News.setMessageTpl($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                localStorage.removeItem('newsId');
                $('#loading').modal('hide');
            },
            success: function (json) {
                json = $.parseJSON(json);
                tinymce.get('text').setContent(json.data.text);
                $.each(json.data, function (k, v) {
                    if (k == 'rubrics') {
                        News.setRubricsTpl(v);
                    } else {
                        $('#' + k).val(v);
                    }
                })
            }
        });
    },
    add: function () {
        $(':button,  :input, #noun_save').attr('disabled', false);
        tinyMCE.get('text').getBody().setAttribute('contenteditable', true);
        $.ajax({
            type: "post",
            url: News.url + 'add/json',
            data: $('#noun').serialize() + '&text=' + tinyMCE.get('text').getContent(),
            error: function () {
                News.setMessageTpl($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (data) {
                data = $.parseJSON(data);
                if (false === data.success) {
                    $(":button, #noun_save").attr('disabled', false);
                    News.setErrorForm(data.errors);
                } else {
                    $(':button,  :input, #noun_save').attr('disabled', true);
                    tinyMCE.get('text').getBody().setAttribute('contenteditable', false);
                    News.addNewsMessageOk();
                }
            }
        });
    },
    setErrorForm: function (errors) {
        $.noty.closeAll();
        $.each(errors, function (k, v) {
            $('#' + k + '_warning').noty({
                text: '<i class="glyphicon glyphicon-exclamation-sign"></i> ' + v,
                type: 'warning',
                dismissQueue: true,
                layout: 'topCenter',
                theme: 'defaultTheme',
                maxVisible: 30
            });
        })
    },
    saveDialog: function (message) {
        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-primary',
                    text: $().technomedia.btnSaveOk,
                    onClick: function (noty) {
                        noty.close();
                        News.add();
                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnSaveCancel,
                    onClick: function (noty) {
                        noty.close();
                        $(':button,  :input, #noun_save').attr('disabled', false);
                        tinyMCE.get('text').getBody().setAttribute('contenteditable', true);
                    }
                }
            ]
        });
    },
    addNewsMessageOk: function () {
        noty({
            text: $().technomedia.addNewsMessageOk,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-primary',
                    text: $().technomedia.addNewsMessageOkBtnList,
                    onClick: function () {
                        $(location).attr("href", News.url);
                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.addNewsMessageOkBtnNew,
                    onClick: function () {
                        $(location).attr("href", News.url + 'editor');
                    }
                }
            ]
        });
    },
    setMessageTpl: function (message) {
        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnClose,
                    onClick: function (noty) {
                        noty.close();
                    }
                }
            ]
        });
    },
    setRubricsTpl: function (rubrics) {
        var selectedDivRubric = $("#rubric");
        $.each(rubrics, function (k, v) {
            selectedDivRubric.append(
                '<button data-id="' + v.name + '" class="btn btn-default btn-xs" style="margin-right:' +
                ' 3px" type="button">'
                + v.short_name + ' ×</button>' +
                '<input id="rubric_' + v.name + '" hidden=""  data-id="' + v.name
                + '" name="' + k + '" value="' + v.name + '">'
            );
        });
    }
};

/**********************************************************************************************************************/
var Rubric = {
    url: getBaseUrl() + 'rubrics/',
    table: $('#rubrics').dataTable(
        {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
            },
            "bFilter": false,
            "processing": true,
            "serverSide": true,
            "bSort": false,
            "ajax": {
                "url": "getlist",
                "data": function (requestDataModifiedGET) {
                    delete requestDataModifiedGET.columns;
                    delete requestDataModifiedGET.order;
                    requestDataModifiedGET.short_name = $('#short_name').val();
                    requestDataModifiedGET.description = $('#description').val();
                    requestDataModifiedGET.of_created_at = $('#of_created_at').val();
                    requestDataModifiedGET.to_created_at = $('#to_created_at').val();
                    requestDataModifiedGET.of_modified_at = $('#of_modified_at').val();
                    requestDataModifiedGET.to_modified_at = $('#to_modified_at').val();
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "short_name"},
                {"data": "path"},
                {"data": "description"},
                {"data": "created_at"},
                {"data": "modified_at"},
                {
                    "data": null,
                    "class": "center",
                    "defaultContent": "<button class='btn btn-default btn-circle' type='button'>" +
                    "<i class='glyphicon glyphicon-pencil'></i>" +
                    "</button>"
                }
            ]
        }
    ),
    init: function () {
        $("#rubric-row").hide();

        $('#addRubric').click(function () {
            $(':button,  :input, #addRubric').attr('disabled', true);
            Rubric.setMessageSave($().technomedia.saveRubricDialogMessage);
        });

        $('#clearForm').click(function () {
            $.noty.closeAll();
            Rubric.clear();
        });

        $('#rubrics tbody').on('click', 'tr', function () {

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else {
                Rubric.table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#add').click(function () {
            Rubric.clear();
            Rubric.setRubric();
            $('#rubric-row').animate({height: 'show'}, 500);
        });

        $('#closeAddRubric, #turn').click(function () {
            $('#rubric-row').animate({height: 'hide'}, 500);
        });

        if ($('#tree').exists()) {
            this.setRubric();
        }

        $('#tree').on('click', 'a', function () {
            $('.tree a[class=selected-tree]').each(function () {
                $(this).removeClass('selected-tree')
            });
            if ($(this).hasClass('selected-tree')) {
                $(this).removeClass('selected-tree');
            }
            else {
                $(this).addClass('selected-tree');
            }
        });

        $('#rubrics tbody').on('click', 'button', function () {
            localStorage.setItem('rubricId', Rubric.table.api().row($(this).parents('tr')).data().id);
            $(location).attr('href', Rubric.url + 'editor');

        });

        if (!!localStorage.getItem('rubricId'))
            this.get();

        $('#search_rubrics').click(function () {
            Rubric.reloadTable();
        });
    },
    reloadTable: function () {
        this.table.api().ajax.reload();
    },
    get: function () {
        var rubricId = localStorage.getItem('rubricId');
        localStorage.removeItem('rubricId');

        $.ajax({
            type: "post",
            url: Rubric.url + 'get/' + rubricId,
            dataType: "json",
            error: function () {
                News.setMessageTpl($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                localStorage.removeItem('newsId');
                $('#loading').modal('hide');
            },
            success: function (json) {
                $.each(json.data, function (field, value) {
                    if (field === 'parent') {
                        $('.tree a').each(function () {
                            $(this).removeClass('selected-tree')
                        });
                        $(".tree a[data-id~='" + value + "']").addClass('selected-tree');
                    } else {
                        $('#' + field).val(value);
                    }
                });
            },
            timeout: 3000
        });
    },
    insertRubricTpl: function (ulId, data) {
        $(data).each(function (key, value) {
            var defaultIcon = ' <span class="fa fa-sitemap fa-fw"></span>';
            if ($(value.data).length > 0) {
                defaultIcon = '<span class="fa fa-folder-o"></span>';
                $('#' + ulId).append(
                    '<li>' +
                    '<a  data-id=' + value.dataId + '>' +
                    defaultIcon + value.value + '</a>' +
                    '<ul id="' + value.dataId + '">'
                );
                Rubric.insertRubricTpl(value.dataId, value.data)
            } else {
                $('#' + ulId).append(
                    '<li>' +
                    '<a  data-id=' + value.dataId + ' >' + defaultIcon + value.value +
                    '</a>' +
                    '</li>'
                );
            }
        });
    },
    add: function () {
        $("div[data-id='error']").empty();

        var parent = $('.tree a[class=selected-tree]').attr('data-id');
        if (undefined === parent) {
            parent = null;
        }

        $.noty.closeAll();
        $(':button,  :input, #addRubric').attr('disabled', false);
        $.ajax({
            type: "POST",
            url: 'add/json',
            data: $('#rubric').serialize() + '&parent=' + parent,
            error: function () {
                Rubric.setMessageTpl($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (data) {
                try {
                    data = $.parseJSON(data);
                    if (false === data.success) {
                        Rubric.setErrorForm(data.errors);
                    } else {
                        Rubric.addRubricMessageOk();
                        Rubric.clear();
                    }
                } catch (e) {
                    Rubric.setMessageTpl($().technomedia.totalError);
                    Rubric.clear();
                }
            }
        });
    },
    clear: function () {
        $('.tree a[class=selected-tree]').each(function () {
            $(this).removeClass('selected-tree')
        });
        $('#rubric')[0].reset();
    },
    setErrorForm: function (error) {
        $.each(error, function (k, v) {

            if (k === 'failureSave')
                Rubric.setMessageTpl(v);

            $('#' + k + '_warning').noty({
                text: '<i class="glyphicon glyphicon-exclamation-sign"></i> ' + v,
                type: 'warning',
                dismissQueue: true,
                layout: 'topCenter',
                theme: 'defaultTheme',
                maxVisible: 30
            });

        })
    },
    setMessageTpl: function (message) {
        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnClose,
                    onClick: function (noty) {
                        Rubric.setRubric();
                        noty.close();
                    }
                }
            ]
        });
    },
    addRubricMessageOk: function () {
        noty({
            text: $().technomedia.addRubricMessageOk,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-primary',
                    text: $().technomedia.addRubricMessageOkBtnList,
                    onClick: function () {
                        $(location).attr("href", Rubric.url);
                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.addRubricMessageOkBtnNew,
                    onClick: function () {
                        $(location).attr("href", Rubric.url + 'editor');
                    }
                }
            ]
        });
    },
    setMessageSave: function (message) {
        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-primary',
                    text: $().technomedia.btnSaveOk,
                    onClick: function ($noty) {
                        $noty.close();
                        Rubric.add();
                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnSaveCancel,
                    onClick: function ($noty) {
                        $(':button,  :input, #addRubric').attr('disabled', false);
                        $noty.close();
                    }
                }
            ]
        });
    },
    setRubric: function () {
        $('.tree').empty();
        $.ajax({
            type: "post",
            url: getBaseUrl() + 'rubrics/get',
            complete: function () {
                $('#rubric .btn-default').each(function () {
                    $('#selected-rubric a[data-id =' + $(this).attr('data-id') + ']').addClass('selected-tree');

                    $('#sel').append('<p id="selected_' + $(this).attr('data-id') + '">' +
                        '<i class="fa fa-check selected-rubric"></i>' +
                        $(this).text().replace('×', '') +
                        '</p>');
                });
            },
            success: function (data) {
                var json = $.parseJSON(data);
                $(json.data.rubrics).each(function (k, v) {
                    var defaultIcon = ' <span class="fa fa-sitemap fa-fw"></span>';
                    if ($(v.data).length > 0) {
                        defaultIcon = '<span class="fa fa-folder-o"></span>';
                    }
                    $('.tree').append(
                        '<li>' +
                        '<a data-id=' + v.dataId + ' >' +
                        defaultIcon + v.value + '</a>' +
                        '<ul id="' + v.dataId + '">'
                    );
                    if ($(v.data).length > 0) {
                        Rubric.insertRubricTpl(v.dataId, v.data);
                    }
                });
            }

        });
    }
};

var SelectedRubric = {
    init: function () {
        $('#get_rubrics').click(function () {
            $('#sel p').each(function () {
                $(this).remove()
            });
            Rubric.setRubric();
        });

        $('#selected-rubric').on('click', 'a', function () {
            $.noty.closeAll();
            if ($(this).hasClass('selected-tree')) {
                $(this).removeClass('selected-tree');
                $('#selected_' + $(this).attr('data-id')).remove()
            }
            else {
                if ($('#selected-rubric a[class=selected-tree]').length == 3) {
                    return SelectedRubric.message($().technomedia.selectedRubricErrorMax);
                }
                $(this).addClass('selected-tree');
                $('#sel').append('<p id="selected_' + $(this).attr('data-id') + '">' +
                    '<i class="fa fa-check selected-rubric"></i>' +
                    $(this).text() +
                    '</p>');
            }
        });

        $('#rubric').on('click', 'button', function () {
            if ($(this).attr('id') == 'get_rubrics')
                return;
            $('#rubric input[data-id=' + $(this).attr('data-id') + ']').remove();
            $(this).remove();
        });

        $('#view_tree_rubrics').click(
            function () {
                $('#myModal .col-md-5').remove();
                $('#myModal .col-md-7').removeClass('col-md-7').addClass('col-md-12');
                $('#myModal .modal-footer').remove();
                $('#selected-rubric-message').remove();
                $('#myModalLabel').text($().technomedia.treeRubricsName);
                Rubric.setRubric();

            }
        );
        $('#relatedTo').click(function () {
            SelectedRubric.relatedTo();
        })
    },
    message: function (message) {
        $('#selected-rubric-message').noty({
            text: '<i class="glyphicon glyphicon-exclamation-sign"></i> ' + message,
            type: 'warning',
            dismissQueue: true,
            layout: 'topCenter',
            theme: 'defaultTheme',
            maxVisible: 30
        });
    },
    relatedTo: function () {

        if ($('#selected-rubric a[class=selected-tree]').length == 0) {
            $.noty.closeAll();
            return this.message($().technomedia.noSelectedRubricError)
        }
        var i = 1;

        $('#rubric .btn-default').each(function () {
            $(this).remove();
            $('#selected-rubric a[class=selected-tree]').each(function () {
                if ($('[data-id=' + $(this).attr('data-id') + ']').length = 0) {
                    $('[data-id=' + $(this).attr('data-id') + ']').remove();
                }
            });

        });

        $('#selected-rubric a[class=selected-tree]').each(function () {
            if ($('#rubric button[data-id=' + $(this).attr('data-id') + ']').length == 1)
                return;

            $("#rubric").append('<button type="button" style="margin-right: 3px" '
                + 'class="btn btn-default btn-xs"  data-id="'
                + $(this).attr('data-id') +
                '">' + $(this).text() + ' &times;</button>');

            $("#rubric").append('<input id="rubric_'
                + $(this).attr('data-id') + '" data-id="' + $(this).attr('data-id')
                + '" hidden value="'
                + $(this).attr('data-id') +
                '" name="rubric_' + i + '"/>');
            i++;
        });

        $('#myModal').modal('hide');
    }
};

var ImageWriter = {
    jcropApi: null,
    table: $('#images')
        .on('xhr.dt', function (e, settings, json) {
            for (var i = 0, ien = json.data.length; i < ien; i++) {
                json.data[i].ico_file = '<img id="image_search" class="img-thumbnail center-block"' +
                    ' data-holder-rendered="true" src="' + json.data[i].ico_file +
                    '" style=" position: relative; display: block;max-width: 50%; max-height: 50%;" alt="140x140">';

                if (json.data[i].count_cropped > 0)
                    json.data[i].count_cropped = '<strong>' + json.data[i].count_cropped + '</strong>&nbsp;<button ' +
                        'class="btn btn-default btn-circle" id="show_images"' +
                        ' type="button"> <i class="glyphicon glyphicon-search "></i></button>';
            }
            // Тут возомжно придется менять адресса изображений а именно путь до них тут нужно
            // будет думать
        }).on('draw.dt', function () {
            $('.img-thumbnail').each(function () {
                $(this).hover(
                    function () {
                        $(this).stop().animate({
                            "max-width": "100%",
                            position: "relative",
                            display: "block",
                            "max-height": "100%"
                        }, 2);
                    },
                    function () {
                        $(this).stop().animate({
                            "max-width": "50%",
                            position: "relative",
                            display: "block",
                            "max-height": "50%"
                        }, 2);
                    }
                )
            })
        }).dataTable(
            {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                },
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "bSort": false,
                "ajax": {
                    "url": getBaseUrl() + "multimedia/images/list",
                    "data": function (requestDataModifiedGET) {
                        delete requestDataModifiedGET.columns;
                        delete requestDataModifiedGET.order;
                        requestDataModifiedGET.title = $('#title').val();
                        requestDataModifiedGET.description = $('#description').val();
                        requestDataModifiedGET.tags = $('#tags').val();
                        requestDataModifiedGET.of_uploaded_at = $('#of_uploaded_at').val();
                        requestDataModifiedGET.to_uploaded_at = $('#to_uploaded_at').val();
                    }
                },
                "columns": [
                    {"data": "id"},
                    {"data": "title"},
                    {"data": "description"},
                    {"data": "ico_file"},
                    {"data": "uploaded_at"},
                    {
                        "data": "count_cropped",
                        "class": "text-center"
                    },
                    {
                        "data": null,
                        "class": "text-center",
                        "defaultContent": '<div class="dropdown"> ' +
                        '<button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true"' +
                        ' aria-expanded="false">' + 'Действия' + '<span class="caret"></span> ' +
                        '</button> <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dLabel"> ' +
                        '<li role="presentation" ><a id="crop"><i class="fa fa-cut"></i> Нарезать фото</a></li>' +
                        '<li role="presentation" ><a id="edit"><i class="fa fa-pencil">' +
                        '</i> Редактировать описание</a></li></ul> </div>'
                    }
                ]
            }
        ),
    init: function () {
        $('#new_photo').hide();
        $('#photo_save').click(function () {
            $.noty.closeAll();
            ImageWriter.addImages();
        });

        $('#search_image').click(function () {
            ImageWriter.reloadTable();
        });
        $('#new_photo').click(function () {
            $(location).attr('href', getBaseUrl() + 'multimedia/image');
        });

        $('#select-size').click(function () {
            $(location).attr('href', getBaseUrl() + 'multimedia/images/crop/' + $('#imagesId').val() + '/' +
                $('input:radio[name=imagesSize]:checked').val());
        });

        $('#images tbody').on('click', '#crop', function () {
            $(location).attr('href', getBaseUrl() + 'multimedia/images/crop/' +
                ImageWriter.table.api().row($(this).parents('tr')).data().id);
        });

        $('#images tbody').on('click', '#show_images', function () {
            $('#preview-list').empty();
            ImageWriter.setCroppedImages(ImageWriter.table.api().row($(this).parents('tr')).data().id);
            $('#croppedImagesShow').modal('show');
        });

        $('#crop-image').click(function () {
            ImageWriter.saveDialog($().technomedia.addCropImagesMessage)
        });
        ImageCrop.init();
    },
    reloadTable: function () {
        this.table.api().ajax.reload();

    },
    setCroppedImages: function (imageId) {
        $.ajax({
            type: "POST",
            url: getBaseUrl() + 'multimedia/images/preview/' + imageId,
            dataType: "json",
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (json) {
                $.each(json.data.data, function (k, v) {
                    $('#preview-list').append(
                        '<div class="well" style="margin-top: 3px; margin-right: 4px" > ' + '<blockquote>' +
                        '<h4>' + v.title + '</h4> ' + '<strong>' + $().technomedia.width + ':' + v.width + 'px ' +
                        $().technomedia.height + ':' + v.height + 'px' + '</strong>' + '</blockquote>' +
                        '<img src="' + v.path + '" class="img-responsive' +
                        ' preview-container" alt="Responsive image"> ' +
                        '</div>'
                    );
                })
            }
        });
    },
    saveDialog: function (message) {
        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-primary',
                    text: $().technomedia.btnSaveOk,
                    onClick: function (noty) {
                        noty.close();
                        ImageWriter.addCropImages();
                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnSaveCancel,
                    onClick: function (noty) {
                        noty.close();
                    }
                }
            ]
        });
    },
    addCropImages: function () {
        $.post(getBaseUrl() + 'multimedia/images/crop', {
            imagesId: $('#imagesId').val(),
            imagesSizeId: $('input:radio[name=imagesSize]:checked').val(),
            x: $('#x').val(),
            y: $('#y').val(),
            w: $('#w').val(),
            h: $('#h').val()
        }, function (json) {
            if (json.success) {
                ImageWriter.setMessageTpl($().technomedia.saveCropImagesOkMessage)
            } else {
                ImageWriter.setMessageTpl($().technomedia.totalError)
            }
        }, 'json');
    },
    setMessageTpl: function (message) {
        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'defaultTheme',
            buttons: [
                {
                    addClass: 'btn btn-success',
                    text: $().technomedia.btnNext,
                    onClick: function (noty) {
                        noty.close();
                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnList,
                    onClick: function (noty) {
                        noty.close();
                        $(location).attr('href', getBaseUrl() + 'multimedia/images/')
                    }
                }
            ]
        });
    },
    addImages: function () {
        var fd = new FormData();
        fd.append('name', $('#name').val());
        fd.append('description', $('#description').val());
        fd.append('tags', $('#tags').val());
        fd.append('image', $('#image')[0].files[0]);
        $.ajax({
            type: "post",
            url: getBaseUrl() + 'multimedia/upload',
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (json) {
                if (false === json.success) {
                    Rubric.setErrorForm(json.errors);
                } else {
                    $('#image_ico').attr('src', json.data.ico);
                    $('#photo_save').hide();
                    $('#new_photo').show();
                }
            },
            error: function (data) {

            }
        })
    },
    setErrorForm: function (error) {
        $.each(error, function (k, v) {
            if (k === 'failureSave')
                Rubric.setMessageTpl(v);
            $('#' + k + '_warning').noty({
                text: '<i class="glyphicon glyphicon-exclamation-sign"></i> ' + v,
                type: 'warning',
                dismissQueue: true,
                layout: 'topCenter',
                theme: 'defaultTheme',
                maxVisible: 30
            });
        })
    }
};

var ImageCrop = {
    api: null,
    boundx: null,
    boundy: null,
    preview: $('#preview-pane'),
    pcnt: $('.preview-container'),
    pimg: $('.preview-container img'),
    xsize: $('.preview-container').width(),
    ysize: $('.preview-container').height(),

    init: function () {
        $('#target').Jcrop({
            onChange: ImageCrop.updatePreview,
            onSelect: ImageCrop.updatePreview,
            aspectRatio: ImageCrop.xsize / ImageCrop.ysize
        }, function () {
            var bounds = this.getBounds();
            ImageCrop.boundx = bounds[0];
            ImageCrop.boundy = bounds[1];
            ImageCrop.api = this;
            ImageCrop.api.setSelect([10, 10, ImageCrop.xsize, ImageCrop.ysize]);
            ImageCrop.api.setOptions({bgColor: 'white', bgOpacity: 0.7});
        });
    },
    updatePreview: function (c) {
        if (parseInt(c.w) > 0) {
            var rx = ImageCrop.xsize / c.w;
            var ry = ImageCrop.ysize / c.h;
            ImageCrop.pimg.css({
                width: Math.round(rx * ImageCrop.boundx) + 'px',
                height: Math.round(ry * ImageCrop.boundy) + 'px',
                marginLeft: '-' + Math.round(rx * c.x) + 'px',
                marginTop: '-' + Math.round(ry * c.y) + 'px'
            });
        }
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
    }
};

var InsertImagesPlugin = {
    table: null,
    init: function () {
        if (this.table === null) {
            this.table = $('#insert-images-materials')
                .on('xhr.dt', function (e, settings, json) {
                    for (var i = 0, ien = json.data.length; i < ien; i++) {
                        json.data[i].ico_file = '<img id="image_search" class="img-thumbnail center-block"' +
                            ' data-holder-rendered="true" src="' + json.data[i].ico_file +
                            '" style=" display: block;max-width: 80%; max-height: 80%;" alt="140x140">';

                        if (json.data[i].count_cropped > 0)
                            json.data[i].count_cropped = '<strong>' + json.data[i].count_cropped +
                                '</strong>&nbsp;<button class="btn btn-default btn-circle" id="show_images"' +
                                ' type="button"> <i class="fa fa-paste"></i></button>';
                    }
                    // Тут возомжно придется менять адресса изображений а именно путь до них тут нужно
                    // будет думать
                }).on('draw.dt', function () {
                    $('.img-thumbnail').each(function () {
                        $(this).hover(
                            function () {
                                $(this).stop().animate({
                                    "max-width": "100%",
                                    display: "block",
                                    "max-height": "100%"
                                }, 2);
                            },
                            function () {
                                $(this).stop().animate({"max-width": "80%", display: "block", "max-height": "80%"}, 2);
                            }
                        )
                    })
                }).dataTable(
                    {
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                        },
                        "bFilter": false,
                        "processing": true,
                        "serverSide": true,
                        "bSort": false,
                        "ajax": {
                            "url": getBaseUrl() + "multimedia/images/list",
                            "data": function (requestDataModifiedGET) {
                                delete requestDataModifiedGET.columns;
                                delete requestDataModifiedGET.order;
                                requestDataModifiedGET.title = $('#title-image-insert').val();
                                requestDataModifiedGET.description = $('#description-image-insert').val();
                                requestDataModifiedGET.tags = $('#tags-image-insert').val();
                                requestDataModifiedGET.of_uploaded_at = $('#of_uploaded_at-image-insert').val();
                                requestDataModifiedGET.to_uploaded_at = $('#to_uploaded_at-image-insert').val();
                            }
                        },
                        "columns": [
                            {"data": "id"},
                            {"data": "title"},
                            {"data": "description"},
                            {"data": "ico_file"},
                            {"data": "uploaded_at"},
                            {
                                "data": "count_cropped",
                                "class": "text-center"
                            }
                        ]
                    }
                )
        } else {
            this.reloadTable();
        }

        $('#insert-images-materials tbody').on('click', '#show_images', function () {
            $('#preview-list').empty();
            InsertImagesPlugin.setCroppedImages(InsertImagesPlugin.table.api().row($(this).parents('tr')).data().id);
            $('#inserting-images-preview').modal('show');
        });

        $('#search_image-image-insert').click(function () {
            InsertImagesPlugin.reloadTable();
        });

        $('#preview_ico').click(function () {
            $('#show_image').attr('src', $('#image-ico').val());
            $('#inserting-show-image').modal('show')
        });

        //$('#preview-list').on('click', '#insert_image', function () {
        //    var img = $($(this).parent()).children('img');
        //    $('#image-ico').empty().val($(img).attr('src'));
        //    $('#inserting-images-preview').modal('hide');
        //})

    },
    setCroppedImages: function (imageId) {
        $.ajax({
            type: "POST",
            url: getBaseUrl() + 'multimedia/images/preview/' + imageId,
            dataType: "json",
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (json) {
                $.each(json.data.data, function (k, v) {

                    $('#preview-list').append(
                        '<div class="well" style="margin-top: 3px; margin-right: 4px" > ' + '<blockquote>' +
                        '<h4>' + v.title + '</h4> ' + '<strong>' + $().technomedia.width + ':' + v.width + 'px ' +
                        $().technomedia.height + ':' + v.height + 'px' + '</strong>' + '</blockquote>' +
                        '<img src="' + v.path +
                        '" class="img-responsive preview-container" alt="Responsive image"> ' +
                        ' <button class="btn  btn-success" id="insert_image" type="button">Вставить </button>' +
                        '</div>'
                    );
                })
            }
        });
    },
    reloadTable: function () {
        this.table.api().ajax.reload();
    },
    insert: function (e) {
        InsertImagesPlugin.init();
        $('#insert_images_in_materials').modal('show');
    }
};

/**********************************************************notification ************************/

var Notification = {
    message: function (message, callback) {
        noty({
            text: message,
            type: 'success',
            dismissQueue: true,
            layout: 'center',
            theme: 'relax',
            modal: true,
            buttons: [
                {
                    addClass: 'btn btn-success',
                    text: $().technomedia.btnClose,
                    onClick: function (noty) {
                        noty.close();
                        if (callback && typeof(callback) == "function")
                            callback();
                    }
                }
            ]
        });
    },
    error: function (message, callback) {
        noty({
            text: message,
            type: 'error',
            dismissQueue: true,
            layout: 'center',
            theme: 'relax',
            modal: true,
            buttons: [
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnClose,
                    onClick: function (noty) {
                        noty.close();
                        if (callback && typeof(callback) == "function")
                            callback();
                    }
                }
            ]
        });
    },
    warning: function (message, callback) {
        noty({
            text: message,
            type: 'warning',
            dismissQueue: true,
            layout: 'center',
            theme: 'relax',
            modal: true,
            buttons: [
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnClose,
                    onClick: function (noty) {
                        noty.close();
                        if (callback && typeof(callback) == "function")
                            callback();
                    }
                }
            ]
        });
    },
    dialog: function (message, callback, action) {
        var text;

        switch (action) {
            case 'delete':
                text = $().technomedia.btnRemoveOk;
                break;
            default :
                text = $().technomedia.btnSaveOk;
                break;
        }

        noty({
            text: message,
            type: 'alert',
            dismissQueue: true,
            layout: 'center',
            theme: 'relax',
            modal: true,
            buttons: [
                {
                    addClass: 'btn btn-primary',
                    text: text,
                    onClick: function (noty) {
                        noty.close();
                        if (callback && typeof(callback) == "function")
                            callback();

                    }
                },
                {
                    addClass: 'btn btn-danger',
                    text: $().technomedia.btnSaveCancel,
                    onClick: function (noty) {
                        noty.close();
                    }
                }
            ]
        });
    },
    errorInForm: function (id, message) {
        if (id != null)
            $('#' + id).noty({
                text: message,
                type: 'error',
                dismissQueue: true,
                layout: 'topCenter',
                theme: 'relax',
                maxVisible: 30,
                animation: {
                    open: 'animated flipInX', // Animate.css class names
                    close: 'animated flipOutX', // Animate.css class names
                    easing: 'swing', // unavailable - no need
                    speed: 500 // unavailable - no need
                }
            });
    }
}

/************************************************************Social *****************************/

var SocialApp = {
    url: getBaseUrl() + 'social/app/',
    appType: [
        {
            text: 'Нет',
            value: 'none',
            selected: true
        },
        {
            text: 'Web-сайт',
            value: 'web',
            selected: false
        }, {
            text: 'Standalone-приложение',
            value: 'standalone',
            selected: false
        }
    ],
    socialSelect: [
        {
            text: 'facebook.com',
            value: 'facebook',
            selected: false,
            description: "Приложение из facebook",
            imageSrc: getBaseUrl() + "images/social/facebook.png"
        },
        {
            text: "vk.com",
            value: 'vkontakte',
            selected: false,
            description: "Приложение из vkontakte",
            imageSrc: getBaseUrl() + "images/social/vkontakte.png"
        }
    ],
    table: $('#apps').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
        },
        "bFilter": false,
        "processing": true,
        "serverSide": true,
        "bSort": false,
        "ajax": {
            "url": getBaseUrl() + 'social/app/list',
            "data": function (requestDataModifiedGet) {
                delete requestDataModifiedGet.columns;
                delete requestDataModifiedGet.order;
            }
        },
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {
                "data": function (row) {
                    switch (row.social_network) {
                        case '0':
                            return "<img src='" + getBaseUrl() + "images/social/facebook.png" + "'/>";
                        case '1':
                            return "<img src='" + getBaseUrl() + "images/social/vkontakte.png" + "'/>";
                    }
                },
                "class": "center"
            },
            {
                "data": null,
                "class": "center",
                "defaultContent": "<button class='btn btn-default btn-circle' data-action='app-edit' type='button'>" +
                "<i class='fa fa-edit'></i>" +
                "</button>" +
                "<button class='btn btn-default btn-circle' data-action='app-admin'" +
                " type='button' style='margin-left: 10px'><i class='fa fa-user'></i>" +
                "</button>" +
                "<button class='btn btn-danger btn-circle' data-action='app-delete'" +
                " type='button' style='margin-left: 10px'><i class='fa fa-trash-o'></i>" +
                "</button>"
            }
        ]
    }),
    init: function () {
        var dataTable = $('#apps tbody');
        var selected = null;

        if ($('#edit').exists())
            selected = $('#social_network_name').val();


        $('#social_network').ddslick({
            data: SocialApp.socialSelect,
            imagePosition: "left",
            selectText: "Выберите социальную сеть",
            defaultSelectedIndex: selected,
            onSelected: function (data) {
                var additionally = $('#additionally');
                $('#social_network_name').val(data.selectedData.value);

                additionally.empty();
                additionally.removeClass('well');
                localStorage.removeItem('appType');


                switch (data.selectedData.value) {
                    case "vkontakte":
                        additionally.addClass('well');
                        additionally.append('<h4>' + $().technomedia.additionally + '</h4>');
                        var html = '<div class="form-group">' +
                            '<label for="exampleInputEmail1">' + $().technomedia.appType + '</label>' +
                            '<select id="app_type" class="form-control">';
                        $.each(SocialApp.appType, function (k, v) {
                            if (v.selected) {
                                html = html + '<option value="' + v.value + '" selected>' + v.text + '</option>'
                            } else {
                                html = html + '<option value="' + v.value + '">' + v.text + '</option>'
                            }
                        });

                        additionally.append(html + '</select>' + '</div>');

                        $('#app_type').change(function () {
                            if ($('#additionally_data').exists())
                                $('#additionally_data').remove();

                            localStorage.setItem('appType', $(this).val());

                            if ($(this).val() === 'standalone') {
                                additionally.append(
                                    '<div id = "additionally_data">' +
                                    '<div class="form-group">' +
                                    '<label for="nameAdmin">' + $().technomedia.additionallyAddAdminName + '</label>' +
                                    '<button onclick="SocialApp.getInfoUser(event)" id="get_user_info" ' +
                                    'style="margin-left: 10px"><i class="glyphicon glyphicon-user"></i> </button>' +
                                    '<input type="text" class="form-control" id="app_admin_name" disabled>' +
                                    '<div id="appAdminName"></div>' +
                                    '</div>' +
                                    '<div class="form-group">' +
                                    '<label for="socialAdminId">' + $().technomedia.additionallySocialAdminId +
                                    '</label><input type="text" class="form-control" id="app_social_admin_id" disabled>' +
                                    '<div id="appSocialAdminId"></div></div>' +
                                    '<div class="form-group">' +
                                    '<label for="accessToken">' + $().technomedia.additionallyAddAccessToken + '</label>' +
                                    '<button id="get_access_token" style="margin-left: 10px;"' +
                                    ' onclick="SocialApp.getAccessToken(event)">' + '<i class="fa fa-key"></i></button>' +
                                    '<input type="text" class="form-control" id="app_access_token" >' +
                                    '<div id="appAccessToken"></div>' +
                                    '</div></div>'
                                )
                            }

                            $('#get_access_token')
                                .attr('title', $().technomedia.addUserAppAccessTokenMessage)
                                .tooltip();

                            $('#get_user_info')
                                .attr('title', $().technomedia.addUserAppMessage)
                                .tooltip();
                        });
                        break;
                }
            }
        });

        $("#upload_ico_file_app").on('click', function (e) {
            e.preventDefault();
            $("#ico_app_file").trigger('click');
        });


        dataTable.on('click', 'button[data-action=app-delete]', function () {
            var data = SocialApp.table.api().row($(this).parents('tr')).data();

            Notification.dialog(
                $().technomedia.deleteAppConfirmMessage + data.name,
                function () {
                    SocialApp.drop(data.id);
                },
                'delete'
            );

        });

        $('#update_app').on('click', function () {
            SocialApp.update()
        });

        dataTable.on('click', 'button[data-action=app-edit]', function () {
            var data = SocialApp.table.api().row($(this).parents('tr')).data();
            localStorage.setItem('appId', data.id);
            $(location).attr('href', SocialApp.url + 'edit/' + data.id);

        });

        dataTable.on('click', 'button[data-action=app-admin]', function () {
            var data = SocialApp.table.api().row($(this).parents('tr')).data();
            localStorage.setItem('appId', data.id);
            $(location).attr('href', SocialApp.url + 'admin/' + data.id);
        });

        $('#ico_app_file').change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function () {
                    $('#app_ico_img').attr('src', reader.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#add_app').on('click', function () {
            $.noty.closeAll();
            Notification.dialog($().technomedia.addAppMessage, function () {
                SocialApp.add()
            });
        });

        $('#social-page tbody').on('click', 'button', function () {
            var form = new FormData;
            var button = $(this);
            form.append('appId', localStorage.getItem('appId'));
            $.each(button.parents('tr').children('td'), function (k, v) {
                var td = $(v);
                if (td.attr('data-name') != 'button') {
                    form.append(td.attr('data-name'), td.text());
                }
            });

            Notification.dialog($().technomedia.addDialogPageMessage, function () {
                button.addClass('disabled');
                SocialApp.addPage(form);
            });

        });
        $('#social-group tbody').on('click', 'button', function () {
            var form = new FormData;
            var button = $(this);
            form.append('appId', localStorage.getItem('appId'));
            $.each(button.parents('tr').children('td'), function (k, v) {
                var td = $(v);
                if (td.attr('data-name') != 'button') {
                    form.append(td.attr('data-name'), td.text());
                }
            });

            Notification.dialog($().technomedia.addDialogGroupMessage, function () {
                button.addClass('disabled');
                SocialApp.addGroup(form);
            });

        });
    },
    getInfoUser: function (e) {
        e.preventDefault();
        var appId = $('#app_id').val();

        if (!appId) {
            Notification.errorInForm('appId', $().technomedia.addAppIdRequired);
            return false;
        }

        VK.init({
            apiId: appId
        });

        var info = function (response) {
            var name = response.session.user.last_name + ' ' + response.session.user.first_name;

            $('#app_admin_name').val(name);
            $('#app_social_admin_id').val(response.session.user.id)
        };

        VK.Auth.login(info);
    },
    getAccessToken: function (e) {
        e.preventDefault();
        var appId = $('#app_id').val();
        var scope = 'wall,photos,audio,video,docs,notes,groups,messages,notifications,stats,ads,notify,friends,offline';
        var redirect = 'https://oauth.vk.com/blank.html';

        if (!appId) {
            Notification.errorInForm('appId', $().technomedia.addAppIdRequired);
            return false;
        }

        var url = VK._domain.main + VK._path.login + '?client_id=' + appId + '&display=popup&response_type=token&v=5.44' +
            '&display=popup&redirect_uri=' + redirect + '&scope=' + scope;

        VK.UI.popup({
            width: 665,
            height: 370,
            url: url
        });
    },
    addGroup: function (data) {
        $.ajax({
            type: "post",
            url: SocialApp.url + 'group/add',
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            error: function () {
                Notification.message($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (json) {
                if (json.success == false) {
                    Notification.message(json.error);
                } else {
                    Notification.message($().technomedia.appAddGroupSuccess);
                    return true;
                }
            }
        })

    }, addPage: function (data) {
        $.ajax({
            type: "post",
            url: SocialApp.url + 'page/add',
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            error: function () {
                Notification.error($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (json) {
                if (json.success == false) {
                    Notification.message(json.error);
                } else {
                    Notification.message($().technomedia.appAddGroupSuccess);
                    return true;
                }
            }
        })

    },
    update: function () {
        var formData = new FormData();
        formData.append('appAccessToken', $('#app_access_token').val());
        formData.append('name', $('#app_name').val());

        $.ajax({
            type: 'post',
            url: SocialApp.url + 'update/' + $('#app').val(),
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            error: function () {
                Notification.error($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (json) {
                if (json.success) {
                    Notification.message('Приложение успешно обновилось!')
                }
            }

        })
    },
    add: function () {
        var formData = new FormData();

        formData.append('formName', 'addApp');
        formData.append('icoAppFile', $('#ico_app_file')[0].files[0]);
        formData.append('name', $('#app_name').val());
        formData.append('socialNetwork', $('#social_network_name').val());
        formData.append('appId', $('#app_id').val());
        formData.append('appSecretKey', $('#app_secret_key').val());

        if (

            'vkontakte' === $('#social_network_name').val() &&
            'standalone' === $('#app_type').val()
        ) {
            formData.append('appAdminName', $('#app_admin_name').val());
            formData.append('appAccessToken', $('#app_access_token').val());
            formData.append('appSocialAdminId', $('#app_social_admin_id').val());
        }

        $.ajax({
            type: "post",
            url: SocialApp.url + 'add',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            error: function () {
                Notification.error($().technomedia.totalError)
            },
            beforeSend: function () {
                $('#loading').modal({
                    backdrop: 'static',
                    keyboard: true
                });
            },
            complete: function () {
                $('#loading').modal('hide');
            },
            success: function (json) {
                if (json.success == false) {
                    $.each(json, function (k, v) {
                        if (k === 'appError' && v === true)
                            v = $().technomedia.appAddError;
                        Notification.errorInForm(k, v);
                    });
                } else {
                    localStorage.setItem('appId', json.id);
                    localStorage.setItem('socialNetwork', json.socialNetwork);

                    if ('standalone' === localStorage.getItem('appType'))
                        Notification.message($().technomedia.addStandaloneApp, function () {
                            $(location).attr(
                                'href', getBaseUrl() + 'vk-callback'
                            )
                        });
                    else
                        Notification.message($().technomedia.appAddSuccess, function () {
                            $(location).attr(
                                'href',
                                SocialApp.url + 'add/admin/' + localStorage.getItem('socialNetwork')
                                + '/' + localStorage.getItem('appId') + '/');
                        });
                }
            }
        });
    },
    drop: function (appId) {
        var data = new FormData();

        data.append('id', appId);

        $.ajax(
            {
                'type': 'post',
                'url': SocialApp.url + 'drop',
                data: data,
                processData: false,
                contentType: false,
                dataType: "json",
                error: function () {
                    Notification.error($().technomedia.totalError)
                },
                beforeSend: function () {
                    $('#loading').modal({
                        backdrop: 'static',
                        keyboard: true
                    });
                },
                complete: function () {
                    $('#loading').modal('hide');
                },
                success: function (json) {
                    SocialApp.reloadTable();
                }
            }
        )
    },
    reloadTable: function () {
        this.table.api().ajax.reload();
    }
};

/******************************************************Social Flow *************************************/
var SocialFlow = {
    url: getBaseUrl() + 'social/flow/',
    drag: true,
    table: $('#flows').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
        },
        "bFilter": false,
        "processing": true,
        "serverSide": true,
        "bSort": false,
        "ajax": {
            "url": getBaseUrl() + 'social/flow/list',
            "data": function (requestDataModifiedGet) {
                delete requestDataModifiedGet.columns;
                delete requestDataModifiedGet.order;
            }
        },
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {
                "data": null,
                "class": "center",
                "defaultContent": "<button class='btn btn-default btn-circle' data-action='flow-edit' type='button'>" +
                "<i class='fa fa-edit'></i>" +
                "</button>" +
                "<button class='btn btn-default btn-circle' data-action='flow-keys'" +
                " type='button' style='margin-left: 10px'><i class='fa fa-key'></i>" +
                "</button>" +
                "<button class='btn btn-danger btn-circle' data-action='flow-delete'" +
                " type='button' style='margin-left: 10px'><i class='fa fa-trash-o'></i>" +
                "</button>"
            }
        ]
    }),
    init: function () {
        var flowSocialApp = $('#flow_social_app'),
            dataTable = $('#flows tbody'),
            fGroups = $('#flow_groups'),
            fPages = $('#flow_pages');

        if (flowSocialApp.exists()) {
            (SocialFlow.getApp(flowSocialApp));
        }

        dataTable.on('click', 'button[data-action=flow-edit]', function () {
            var data = SocialFlow.table.api().row($(this).parents('tr')).data();
            localStorage.setItem('flowId', data.id);
            $(location).attr('href', SocialFlow.url + 'edit/' + data.id);

        });

        dataTable.on('click', 'button[data-action=flow-keys]', function () {
            $('#flow_keys').modal({
                backdrop: 'static',
                keyboard: true
            });
            var data = SocialFlow.table.api().row($(this).parents('tr')).data();
            var fd = new FormData();
            fd.append('id', data.id);

            $.ajax(
                {
                    'type': 'post',
                    'url': SocialFlow.url + 'get-access',
                    data: fd,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (json) {
                        if (json.success == true) {
                            $('#flow_secret_key').val(json.secretKey);
                            $('#flow_access_token').val(json.accessToken);
                        }
                    }
                }
            );

            $('#flow_update_access_token').on('click', function () {
                $.ajax(
                    {
                        'type': 'post',
                        'url': SocialFlow.url + 'update-access',
                        data: fd,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function (json) {
                            if (json.success == true) {
                                $('#flow_access_token').val(json.accessToken);
                            }
                        }
                    }
                )
            });

        });

        dataTable.on('click', 'button[data-action=flow-delete]', function () {
            var data = SocialFlow.table.api().row($(this).parents('tr')).data();
            Notification.dialog(
                $().technomedia.deleteFlowConfirmMessage,
                function () {
                    SocialFlow.drop(data.id)
                },
                'delete'
            );
        });

        fGroups.on('click', 'button', function () {
            $(this).parent().remove();
        });

        fPages.on('click', 'button', function () {
            $(this).parent().remove();
        });

        $('#flow_add').on('click', function () {
            $.noty.closeAll();
            var gIds = [],
                pIds = [],
                fd = new FormData();

            var wrapId = function (ul) {
                $.each(
                    ul.children('li'),
                    function (k, v) {
                        var li = $(v);
                        if (li.attr('data-type') == 'page')
                            pIds.push(li.attr('data-id'));
                        else if (li.attr('data-type') == 'group')
                            gIds.push(li.attr('data-id'))
                    }
                )
            };

            wrapId(fGroups);
            wrapId(fPages);

            if (gIds.length == 0 && pIds.length == 0) {
                Notification.warning($().technomedia.addFlowError);
                return false;
            }

            fd.append('name', $('#flow_name').val());
            fd.append('gIds', JSON.stringify(gIds));
            fd.append('pIds', JSON.stringify(pIds));
            SocialFlow.add(fd);
        });

        $('#flow_save').on('click', function () {
            $.noty.closeAll();
            var gIds = [],
                pIds = [],
                fd = new FormData();

            var wrapId = function (ul) {
                $.each(
                    ul.children('li'),
                    function (k, v) {
                        var li = $(v);
                        if (li.attr('data-type') == 'page')
                            pIds.push(li.attr('data-id'));
                        else if (li.attr('data-type') == 'group')
                            gIds.push(li.attr('data-id'))
                    }
                )
            };

            wrapId(fGroups);
            wrapId(fPages);

            if (gIds.length == 0 && pIds.length == 0) {
                Notification.warning($().technomedia.addFlowError);
                return false;
            }

            fd.append('name', $('#flow_name').val());
            fd.append('gIds', JSON.stringify(gIds));
            fd.append('pIds', JSON.stringify(pIds));
            fd.append('flowId', $('#flow_id').val());
            SocialFlow.save(fd);
        });
    },
    drop: function (flowId) {
        var data = new FormData();

        data.append('id', flowId);

        $.ajax(
            {
                'type': 'post',
                'url': SocialFlow.url + 'drop',
                data: data,
                processData: false,
                contentType: false,
                dataType: "json",
                error: function () {
                    Notification.error($().technomedia.totalError)
                },
                beforeSend: function () {
                    $('#loading').modal({
                        backdrop: 'static',
                        keyboard: true
                    });
                },
                complete: function () {
                    $('#loading').modal('hide');
                },
                success: function (json) {
                    SocialFlow.reloadTable();
                }
            }
        )

    },
    add: function (form) {
        $.ajax({
            type: 'post',
            url: SocialFlow.url + 'add',
            processData: false,
            contentType: false,
            data: form,
            dataType: "json",
            success: function (json) {
                if (json.success == false) {
                    $.each(json, function (k, v) {
                        Notification.errorInForm(k, v);
                    })
                } else {
                    Notification.message(
                        $().technomedia.addFlowOk,
                        function () {
                            $(location).attr(
                                'href', SocialFlow.url
                            )
                        }
                    )
                }
            }
        })
    },
    save: function (form) {
        $.ajax({
            type: 'post',
            url: SocialFlow.url + 'save',
            processData: false,
            contentType: false,
            data: form,
            dataType: "json",
            success: function (json) {
                if (json.success == false) {
                    $.each(json, function (k, v) {
                        Notification.errorInForm(k, v);
                    })
                } else {
                    Notification.message(
                        $().technomedia.saveFlowOk,
                        function () {
                            $(location).attr(
                                'href', SocialFlow.url
                            )
                        }
                    )
                }
            }
        })
    },
    draging: function (drag, place, selector, inf) {
        var object = $(selector);
        var sInf = $(inf);

        $.each(object.children('li'), function (k, v) {
            SocialFlow.drag = true;
            if (
                $(v).attr('data-id') == drag.attr('data-id') &&
                place.parent().attr('id') == object.attr('id')
            ) {
                SocialFlow.drag = false;
                return false;
            }
        });


        place.parent().on('click', 'button', function () {
            $(this).parent().remove();
        });

        if (false == SocialFlow.drag) return false;


        if (place.parent().attr('id') != object.attr('id')) {
            drag.children('button').remove();
            place.filter(':visible')
                .after(drag.append("<button type='button' class='drop-sortable'>×</button>"))
        } else {
            drag.children('button').remove();
            place.filter(':visible').after(drag);
            if (object.children('li').exists()) {
                sInf.hide();
            }
        }

        drag.trigger('dragend.h5s');

        if (false == object.children('li').exists())
            sInf.show();

        return false;
    },
    selectApp: function (data) {

        var formData = new FormData();
        var fGroups = $('#flow_groups');
        var fPages = $('#flow_pages');
        var gIds = [];
        var pIds = [];

        $.each(fGroups.children('li'), function (k, v) {
            gIds.push($(v).attr('data-id'));
        });

        $.each(fPages.children('li'), function (k, v) {
            pIds.push($(v).attr('data-id'));
        });

        formData.append('appId', data.selectedData.value);
        formData.append('gIds', gIds);
        formData.append('pIds', pIds);

        $.ajax({
            type: 'post',
            url: SocialFlow.url + 'get-group',
            processData: false,
            contentType: false,
            data: formData,
            dataType: "json",
            success: function (response) {
                var groups = $('#groups');
                var pages = $('#pages');
                $('#no_page').hide();
                $('#no_group').hide();

                groups.empty();
                pages.empty();

                $.each(response.groups, function (k, v) {
                    groups.append(
                        "<li data-type='group' data-id='" + v.id + "'><strong>" + v.name + "</strong></li>"
                    )
                });

                $.each(response.pages, function (k, v) {
                    pages.append(
                        "<li data-type='page' data-id='" + v.id + "'><strong>" + v.name + "</strong></li>"
                    )
                });

                if (0 == response.groups.length)
                    $('#no_group').show();

                if (0 == response.pages.length)
                    $('#no_page').show();

                $('#groups, #flow_groups').sortable({
                    connectWith: '.connected',
                    drop: function (drag, place) {
                        return SocialFlow.draging(drag, place, '#groups', '#no_group');
                    }
                });

                $('#pages, #flow_pages').sortable({
                    connectWith: '.connected',
                    drop: function (drag, place) {
                        return SocialFlow.draging(drag, place, '#pages', '#no_page');
                    }
                });
            }
        });

    },
    getApp: function (flow) {
        $.ajax(
            {
                'type': 'post',
                'url': SocialFlow.url + 'get-app',
                processData: false,
                contentType: false,
                dataType: "json",
                error: function () {
                    Notification.error($().technomedia.totalError)
                },
                beforeSend: function () {
                    $('#loading').modal({
                        backdrop: 'static',
                        keyboard: true
                    });
                },
                complete: function () {
                    $('#loading').modal('hide');
                },
                success: function (response) {
                    flow.ddslick({
                        data: response.data,
                        imagePosition: "left",
                        selectText: "Выберите приложение",
                        onSelected: function (data) {
                            SocialFlow.selectApp(data);
                        }
                    })
                }
            }
        );
    },
    reloadTable: function () {
        this.table.api().ajax.reload();
    }
};

var SocialHistory = {
    url: getBaseUrl() + 'social/flow/',
    drag: true,
    table: $('#social-history')
        .on('xhr.dt', function (e, settings, json) {
            for (var i = 0, ien = json.data.length; i < ien; i++) {
                if (json.data[i].published == 't') {
                    json.data[i].published = '<i class="fa fa-check text-success"></i>';
                    json.data[i].action = '<strong>' + '</strong>'
                        + '<button class="btn btn-success btn-xs" id="edit-link" type="button">'
                        + '<i class="fa fa-refresh"></i></button>';
                } else {
                    json.data[i].published = '<i class="fa fa-road text-danger"></i>';
                    json.data[i].action = '<strong>' + '</strong>'
                        + '<button class="btn btn-success btn-xs" id="edit-link" type="button" disabled>'
                        + '<i class="fa fa-refresh"></i></button>';
                }
            }
        }).dataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
            },
            "bFilter": false,
            "processing": true,
            "serverSide": true,
            "bSort": false,
            "ajax": {
                "url": getBaseUrl() + 'social/history/list',
                "data": function (requestDataModifiedGet) {
                    delete requestDataModifiedGet.columns;
                    delete requestDataModifiedGet.order;
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "description"},
                {"data": "link_url"},
                {"data": "img_url"},
                {
                    "data": "published",
                    "class": "text-center"
                },
                {
                    "data": "action",
                    "class": "text-center"
                }
            ]
        }),
    init: function () {
        $('#social-history').on('click', '#edit-link', function () {
            $.noty.closeAll();
            $('#edit-link-id').val(SocialHistory.table.api().row(jQuery(this).parents('tr')).data().id);
            $('#edit-description').val(SocialHistory.table.api().row(jQuery(this).parents('tr')).data().description);
            $('#edit-link-url').val(SocialHistory.table.api().row(jQuery(this).parents('tr')).data().link_url);
            $('#edit-img-url').val(SocialHistory.table.api().row(jQuery(this).parents('tr')).data().img_url);
            $('#update-history-link').modal('show');
        });
    },
    update: function (data) {
        $('#update-history-link').modal('show');
    }
};


SocialHistory.init();
SelectedRubric.init();
News.init();
Articles.init();
Rubric.init();
ImageWriter.init();
SocialApp.init();
SocialFlow.init();
