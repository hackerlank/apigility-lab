/*
 * Kendo UI v2015.1.429 (http://www.telerik.com/kendo-ui)
 * Copyright 2015 Telerik AD. All rights reserved.
 *
 * Kendo UI commercial licenses may be obtained at
 * http://www.telerik.com/purchase/license-agreement/kendo-ui-complete
 * If you do not own a commercial license, this file shall be governed by the trial license terms.
 */
!function (e, define) {
    define(["./kendo.data.min", "./kendo.draganddrop.min"], e)
}(function () {
    return function (e, t) {
        function n(e) {
            return function (t) {
                var n = t.children(".k-animation-container");
                return n.length || (n = t), n.children(e)
            }
        }

        function i(e) {
            return p.template(e, {useWithBlock: !1})
        }

        function r(e) {
            return e.find("> div .k-checkbox [type=checkbox]")
        }

        function o(e) {
            return function (t, n) {
                n = n.closest(G);
                var i, r = n.parent();
                return r.parent().is("li") && (i = r.parent()), this._dataSourceMove(t, r, i, function (t, i) {
                    return this._insert(t.data(), i, n.index() + e)
                })
            }
        }

        function a(t, n) {
            for (var i; t && "ul" != t.nodeName.toLowerCase();)i = t, t = t.nextSibling, 3 == i.nodeType && (i.nodeValue = e.trim(i.nodeValue)), f.test(i.className) ? n.insertBefore(i, n.firstChild) : n.appendChild(i)
        }

        function s(t) {
            var n = t.children("div"), i = t.children("ul"), r = n.children(".k-icon"), o = t.children(":checkbox"), s = n.children(".k-in");
            t.hasClass("k-treeview") || (n.length || (n = e("<div />").prependTo(t)), !r.length && i.length ? r = e("<span class='k-icon' />").prependTo(n) : i.length && i.children().length || (r.remove(), i.remove()), o.length && e("<span class='k-checkbox' />").appendTo(n).append(o), s.length || (s = t.children("a").eq(0).addClass("k-in"), s.length || (s = e("<span class='k-in' />")), s.appendTo(n), n.length && a(n[0].nextSibling, s[0])))
        }

        function l(e) {
            var t = this;
            t.treeview = e, t.hovered = e.element, t._draggable = new g.Draggable(e.element, {
                filter: "div:not(.k-state-disabled) .k-in",
                hint: function (t) {
                    return e.templates.dragClue({item: e.dataItem(t), treeview: e.options})
                },
                cursorOffset: {left: 10, top: p.support.mobileOS ? -40 / p.support.zoomLevel() : 10},
                dragstart: x(t.dragstart, t),
                dragcancel: x(t.dragcancel, t),
                drag: x(t.drag, t),
                dragend: x(t.dragend, t),
                $angular: e.options.$angular
            })
        }

        var c, d, u, h, f, p = window.kendo, g = p.ui, m = p.data, v = e.extend, _ = p.template, y = e.isArray, w = g.Widget, b = m.HierarchicalDataSource, x = e.proxy, k = p.keys, C = ".kendoTreeView", S = "select", T = "check", A = "navigate", D = "expand", M = "change", E = "error", P = "checked", I = "indeterminate", z = "collapse", B = "dragstart", L = "drag", R = "drop", F = "dragend", O = "dataBound", N = "click", H = "visibility", V = "undefined", U = "k-state-hover", W = "k-treeview", j = ":visible", G = ".k-item", q = "string", $ = "aria-selected", Y = "aria-disabled", K = {
            text: "dataTextField",
            url: "dataUrlField",
            spriteCssClass: "dataSpriteCssClassField",
            imageUrl: "dataImageUrlField"
        }, Q = function (e) {
            return "object" == typeof HTMLElement ? e instanceof HTMLElement : e && "object" == typeof e && 1 === e.nodeType && typeof e.nodeName === q
        };
        d = n(".k-group"), u = n(".k-group,.k-content"), h = function (e) {
            return e.children("div").children(".k-icon")
        }, f = /k-sprite/, c = p.ui.DataBoundWidget.extend({
            init: function (e, t) {
                var n, i, r = this, o = !1, a = t && !!t.dataSource;
                y(t) && (n = !0, t = {dataSource: t}), t && typeof t.loadOnDemand == V && y(t.dataSource) && (t.loadOnDemand = !1), w.prototype.init.call(r, e, t), e = r.element, t = r.options, i = e.is("ul") && e || e.hasClass(W) && e.children("ul"), o = !a && i.length, o && (t.dataSource.list = i), r._animation(), r._accessors(), r._templates(), e.hasClass(W) ? (r.wrapper = e, r.root = e.children("ul").eq(0)) : (r._wrapper(), i && (r.root = e, r._group(r.wrapper))), r._tabindex(), r.root.attr("role", "tree"), r._dataSource(o), r._attachEvents(), r._dragging(), o ? r._syncHtmlAndDataSource() : t.autoBind && (r._progress(!0), r.dataSource.fetch()), t.checkboxes && t.checkboxes.checkChildren && r.updateIndeterminate(), r.element[0].id && (r._ariaId = p.format("{0}_tv_active", r.element[0].id)), p.notify(r)
            },
            _attachEvents: function () {
                var t = this, n = ".k-in:not(.k-state-selected,.k-state-disabled)", i = "mouseenter";
                t.wrapper.on(i + C, ".k-in.k-state-selected", function (e) {
                    e.preventDefault()
                }).on(i + C, n, function () {
                    e(this).addClass(U)
                }).on("mouseleave" + C, n, function () {
                    e(this).removeClass(U)
                }).on(N + C, n, x(t._click, t)).on("dblclick" + C, ".k-in:not(.k-state-disabled)", x(t._toggleButtonClick, t)).on(N + C, ".k-plus,.k-minus", x(t._toggleButtonClick, t)).on("keydown" + C, x(t._keydown, t)).on("focus" + C, x(t._focus, t)).on("blur" + C, x(t._blur, t)).on("mousedown" + C, ".k-in,.k-checkbox :checkbox,.k-plus,.k-minus", x(t._mousedown, t)).on("change" + C, ".k-checkbox :checkbox", x(t._checkboxChange, t)).on("click" + C, ".k-checkbox :checkbox", x(t._checkboxClick, t)).on("click" + C, ".k-request-retry", x(t._retryRequest, t)).on("click" + C, function (n) {
                    e(n.target).is(":kendoFocusable") || t.focus()
                })
            },
            _checkboxClick: function (t) {
                var n = e(t.target);
                n.data(I) && (n.data(I, !1).prop(I, !1).prop(P, !0), this._checkboxChange(t))
            },
            _syncHtmlAndDataSource: function (e, t) {
                var n, i, o, a, s, l, c, d;
                for (e = e || this.root, t = t || this.dataSource, n = t.view(), i = p.attr("uid"), o = p.attr("expanded"), a = this.options.checkboxes, s = e.children("li"), l = 0; s.length > l; l++)d = n[l], c = s.eq(l), c.attr("role", "treeitem").attr(i, d.uid), d.expanded = "true" === c.attr(o), a && (d.checked = r(c).prop(P)), this._syncHtmlAndDataSource(c.children("ul"), d.children)
            },
            _animation: function () {
                var e = this.options, t = e.animation;
                t === !1 ? t = {
                    expand: {effects: {}},
                    collapse: {hide: !0, effects: {}}
                } : t.collapse && "effects"in t.collapse || (t.collapse = v({reverse: !0}, t.expand)), v(t.collapse, {hide: !0}), e.animation = t
            },
            _dragging: function () {
                var e = this.options.dragAndDrop, t = this.dragging;
                e && !t ? this.dragging = new l(this) : !e && t && (t.destroy(), this.dragging = null)
            },
            _templates: function () {
                var e = this, t = e.options, n = x(e._fieldAccessor, e);
                t.template && typeof t.template == q ?
                    t.template = _(t.template) :
                t.template || (t.template = i("# var text = " + n("text") + "(data.item); ## if (typeof data.item.enco" +
                "ded != 'undefined' && data.item.encoded === false) {##= text ## } else { ##: text ## } #")),
                    e._checkboxes(), e.templates = {
                    wrapperCssClass: function (e, t) {
                        var n = "k-item", i = t.index;
                        return e.firstLevel && 0 === i && (n += " k-first"), i == e.length - 1 && (n += " k-last"), n
                    },
                    cssClass: function (e, t) {
                        var n = "", i = t.index, r = e.length - 1;
                        return e.firstLevel && 0 === i && (n += "k-top "), n += 0 === i && i != r ? "k-top" : i == r ? "k-bot" : "k-mid"
                    },
                    textClass: function (e) {
                        var t = "k-in";
                        return e.enabled === !1 && (t += " k-state-disabled"), e.selected === !0 && (t += " k-state-selected"), t
                    },
                    toggleButtonClass: function (e) {
                        var t = "k-icon";
                        return t += e.expanded !== !0 ? " k-plus" : " k-minus", e.enabled === !1 && (t += "-disabled"), t
                    },
                    groupAttributes: function (e) {
                        var t = "";
                        return e.firstLevel || (t = "role='group'"), t + (e.expanded !== !0 ? " style='display:none'" : "")
                    },
                    groupCssClass: function (e) {
                        var t = "k-group";
                        return e.firstLevel && (t += " k-treeview-lines"), t
                    },
                    dragClue: i("<div class='k-header k-drag-clue'><span class='k-icon k-drag-status' />#= data.treeview.template(data) #</div>"),
                    group: i("<ul class='#= data.r.groupCssClass(data.group) #'#= data.r.groupAttributes(data.group) #>#= data.renderItems(data) #</ul>"),
                    itemContent: i("# var imageUrl = " + n("imageUrl") + "(data.item); ## var spriteCssClass = " + n("spriteCssClass") + "(data.item); ## if (imageUrl) { #<img class='k-image' alt='' src='#= imageUrl #'># } ## if (spriteCssClass) { #<span class='k-sprite #= spriteCssClass #' /># } ##= data.treeview.template(data) #"),
                    itemElement: i("# var item = data.item, r = data.r; ## var url = " + n("url") + "(item); #<div class='#= r.cssClass(data.group, item) #'># if (item.hasChildren) { #<span class='#= r.toggleButtonClass(item) #' role='presentation' /># } ## if (data.treeview.checkboxes) { #<span class='k-checkbox' role='presentation'>#= data.treeview.checkboxes.template(data) #</span># } ## var tag = url ? 'a' : 'span'; ## var textAttr = url ? ' href=\\'' + url + '\\'' : ''; #<#=tag#  class='#= r.textClass(item) #'#= textAttr #>#= r.itemContent(data) #</#=tag#></div>"),
                    item: i("# var item = data.item, r = data.r; #<li role='treeitem' class='#= r.wrapperCssClass(data.group, item) #' " + p.attr("uid") + "='#= item.uid #' aria-selected='#= item.selected ? \"true\" : \"false \" #' #=item.enabled === false ? \"aria-disabled='true'\" : ''## if (item.expanded) { #data-expanded='true' aria-expanded='true'# } #>#= r.itemElement(data) #</li>"),
                    loading: i("<div class='k-icon k-loading' /> #: data.messages.loading #"),
                    retry: i("#: data.messages.requestFailed # <button class='k-button k-request-retry'>#: data.messages.retry #</button>")
                }
            },
            items: function () {
                return this.element.find(".k-item > div:first-child")
            },
            setDataSource: function (e) {
                var t = this.options;
                t.dataSource = e, this._dataSource(), this.dataSource.fetch(), t.checkboxes && t.checkboxes.checkChildren && this.updateIndeterminate()
            },
            _bindDataSource: function () {
                this._refreshHandler = x(this.refresh, this), this._errorHandler = x(this._error, this), this.dataSource.bind(M, this._refreshHandler), this.dataSource.bind(E, this._errorHandler)
            },
            _unbindDataSource: function () {
                var e = this.dataSource;
                e && (e.unbind(M, this._refreshHandler), e.unbind(E, this._errorHandler))
            },
            _dataSource: function (e) {
                function t(e) {
                    for (var n = 0; e.length > n; n++)e[n]._initChildren(), e[n].children.fetch(), t(e[n].children.view())
                }

                var n = this, i = n.options, r = i.dataSource;
                r = y(r) ? {data: r} : r, n._unbindDataSource(), r.fields || (r.fields = [{field: "text"}, {field: "url"}, {field: "spriteCssClass"}, {field: "imageUrl"}]), n.dataSource = r = b.create(r), e && (r.fetch(), t(r.view())), n._bindDataSource()
            },
            events: [B, L, R, F, O, D, z, S, M, A, T],
            options: {
                name: "TreeView",
                dataSource: {},
                animation: {expand: {effects: "expand:vertical", duration: 200}, collapse: {duration: 100}},
                messages: {loading: "Loading...", requestFailed: "Request failed.", retry: "Retry"},
                dragAndDrop: !1,
                checkboxes: !1,
                autoBind: !0,
                loadOnDemand: !0,
                template: "",
                dataTextField: null
            },
            _accessors: function () {
                var e, t, n, i = this, r = i.options, o = i.element;
                for (e in K)t = r[K[e]], n = o.attr(p.attr(e + "-field")), !t && n && (t = n), t || (t = e), y(t) || (t = [t]), r[K[e]] = t
            },
            _fieldAccessor: function (t) {
                var n = this.options[K[t]], i = n.length, r = "(function(item) {";
                return 0 === i ? r += "return item['" + t + "'];" : (r += "var levels = [" + e.map(n, function (e) {
                    return "function(d){ return " + p.expr(e) + "}"
                }).join(",") + "];", r += "return levels[Math.min(item.level(), " + i + "-1)](item)"), r += "})"
            },
            setOptions: function (e) {
                w.fn.setOptions.call(this, e), this._animation(), this._dragging(), this._templates()
            },
            _trigger: function (e, t) {
                return this.trigger(e, {node: t.closest(G)[0]})
            },
            _setChecked: function (t, n) {
                if (t && e.isFunction(t.view))for (var i = 0, r = t.view(); r.length > i; i++)r[i][P] = n, r[i].children && this._setChecked(r[i].children, n)
            },
            _setIndeterminate: function (e) {
                var t, n, i, o = d(e), a = !0;
                if (o.length && (t = r(o.children()), n = t.length)) {
                    if (n > 1) {
                        for (i = 1; n > i; i++)if (t[i].checked != t[i - 1].checked || t[i].indeterminate || t[i - 1].indeterminate) {
                            a = !1;
                            break
                        }
                    } else a = !t[0].indeterminate;
                    return r(e).data(I, !a).prop(I, !a).prop(P, a && t[0].checked)
                }
            },
            updateIndeterminate: function (e) {
                var t, n, i;
                if (e = e || this.wrapper, t = d(e).children(), t.length) {
                    for (n = 0; t.length > n; n++)this.updateIndeterminate(t.eq(n));
                    i = this._setIndeterminate(e), i && i.prop(P) && (this.dataItem(e).checked = !0)
                }
            },
            _bubbleIndeterminate: function (e) {
                if (e.length) {
                    var t, n = this.parent(e);
                    n.length && (this._setIndeterminate(n), t = n.children("div").find(".k-checkbox :checkbox"), t.prop(I) === !1 ? this.dataItem(n).set(P, t.prop(P)) : this.dataItem(n).checked = !1, this._bubbleIndeterminate(n))
                }
            },
            _checkboxChange: function (t) {
                var n = e(t.target), i = n.prop(P), r = n.closest(G);
                this.dataItem(r).set(P, i), this._trigger(T, r)
            },
            _toggleButtonClick: function (t) {
                this.toggle(e(t.target).closest(G))
            },
            _mousedown: function (t) {
                var n = e(t.currentTarget).closest(G);
                this._clickTarget = n, this.current(n)
            },
            _focusable: function (e) {
                return e && e.length && e.is(":visible") && !e.find(".k-in:first").hasClass("k-state-disabled")
            },
            _focus: function () {
                var t = this.select(), n = this._clickTarget;
                p.support.touch || (n && n.length && (t = n), this._focusable(t) || (t = this.current()), this._focusable(t) || (t = this._nextVisible(e())), this.current(t))
            },
            focus: function () {
                var e, t = this.wrapper, n = t[0], i = [], r = [], o = document.documentElement;
                do n = n.parentNode, n.scrollHeight > n.clientHeight && (i.push(n), r.push(n.scrollTop)); while (n != o);
                for (t.focus(), e = 0; i.length > e; e++)i[e].scrollTop = r[e]
            },
            _blur: function () {
                this.current().find(".k-in:first").removeClass("k-state-focused")
            },
            _enabled: function (e) {
                return !e.children("div").children(".k-in").hasClass("k-state-disabled")
            },
            parent: function (t) {
                var n, i, r = /\bk-treeview\b/, o = /\bk-item\b/;
                typeof t == q && (t = this.element.find(t)), Q(t) || (t = t[0]), i = o.test(t.className);
                do t = t.parentNode, o.test(t.className) && (i ? n = t : i = !0); while (!r.test(t.className) && !n);
                return e(n)
            },
            _nextVisible: function (e) {
                function t(e) {
                    for (; e.length && !e.next().length;)e = i.parent(e);
                    return e.next().length ? e.next() : e
                }

                var n, i = this, r = i._expanded(e);
                return e.length && e.is(":visible") ? r ? (n = d(e).children().first(), n.length || (n = t(e))) : n = t(e) : n = i.root.children().eq(0), i._enabled(n) || (n = i._nextVisible(n)), n
            },
            _previousVisible: function (e) {
                var t, n, i = this;
                if (!e.length || e.prev().length)for (n = e.length ? e.prev() : i.root.children().last(); i._expanded(n) && (t = d(n).children().last(), t.length);)n = t; else n = i.parent(e) || e;
                return i._enabled(n) || (n = i._previousVisible(n)), n
            },
            _keydown: function (n) {
                var i, r = this, o = n.keyCode, a = r.current(), s = r._expanded(a), l = a.find(".k-checkbox:first :checkbox"), c = p.support.isRtl(r.element);
                n.target == n.currentTarget && (!c && o == k.RIGHT || c && o == k.LEFT ? s ? i = r._nextVisible(a) : r.expand(a) : !c && o == k.LEFT || c && o == k.RIGHT ? s ? r.collapse(a) : (i = r.parent(a), r._enabled(i) || (i = t)) : o == k.DOWN ? i = r._nextVisible(a) : o == k.UP ? i = r._previousVisible(a) : o == k.HOME ? i = r._nextVisible(e()) : o == k.END ? i = r._previousVisible(e()) : o == k.ENTER ? a.find(".k-in:first").hasClass("k-state-selected") || r._trigger(S, a) || r.select(a) : o == k.SPACEBAR && l.length && (l.prop(P, !l.prop(P)).data(I, !1).prop(I, !1), r._checkboxChange({target: l}), i = a), i && (n.preventDefault(), a[0] != i[0] && (r._trigger(A, i), r.current(i))))
            },
            _click: function (t) {
                var n, i = this, r = e(t.currentTarget), o = u(r.closest(G)), a = r.attr("href");
                n = a ? "#" == a || a.indexOf("#" + this.element.id + "-") >= 0 : o.length && !o.children().length, n && t.preventDefault(), r.hasClass(".k-state-selected") || i._trigger(S, r) || i.select(r)
            },
            _wrapper: function () {
                var e, t, n = this, i = n.element, r = "k-widget k-treeview";
                i.is("ul") ? (e = i.wrap("<div />").parent(), t = i) : (e = i, t = e.children("ul").eq(0)), n.wrapper = e.addClass(r), n.root = t
            },
            _group: function (e) {
                var t = this, n = e.hasClass(W), i = {
                    firstLevel: n,
                    expanded: n || t._expanded(e)
                }, r = e.children("ul");
                r.addClass(t.templates.groupCssClass(i)).css("display", i.expanded ? "" : "none"), t._nodes(r, i)
            },
            _nodes: function (t, n) {
                var i, r = this, o = t.children("li");
                n = v({length: o.length}, n), o.each(function (t, o) {
                    o = e(o), i = {index: t, expanded: r._expanded(o)}, s(o), r._updateNodeClasses(o, n, i), r._group(o)
                })
            },
            _checkboxes: function () {
                var e, t = this.options, n = t.checkboxes;
                n && (e =
                    "<input type='checkbox' #= (item.enabled === false) ? 'disabled' : " +
                    "'' # #= item.checked ? 'checked' : '' #",

                n.name && (e += " name='" + n.name + "'"), e += " />",
                    n = v({template: e}, t.checkboxes),
                typeof n.template == q && (n.template = _(n.template)), t.checkboxes = n)
            },
            _updateNodeClasses: function (e, t, n) {
                var i = e.children("div"), r = e.children("ul"), o = this.templates;
                e.hasClass("k-treeview") || (n = n || {}, n.expanded = typeof n.expanded != V ? n.expanded : this._expanded(e), n.index = typeof n.index != V ? n.index : e.index(), n.enabled = typeof n.enabled != V ? n.enabled : !i.children(".k-in").hasClass("k-state-disabled"), t = t || {}, t.firstLevel = typeof t.firstLevel != V ? t.firstLevel : e.parent().parent().hasClass(W), t.length = typeof t.length != V ? t.length : e.parent().children().length, e.removeClass("k-first k-last").addClass(o.wrapperCssClass(t, n)), i.removeClass("k-top k-mid k-bot").addClass(o.cssClass(t, n)), i.children(".k-in").removeClass("k-in k-state-default k-state-disabled").addClass(o.textClass(n)), (r.length || "true" == e.attr("data-hasChildren")) && (i.children(".k-icon").removeClass("k-plus k-minus k-plus-disabled k-minus-disabled").addClass(o.toggleButtonClass(n)), r.addClass("k-group")))
            },
            _processNodes: function (t, n) {
                var i = this;
                i.element.find(t).each(function (t, r) {
                    n.call(i, t, e(r).closest(G))
                })
            },
            dataItem: function (t) {
                var n = e(t).closest(G).attr(p.attr("uid")), i = this.dataSource;
                return i && i.getByUid(n)
            },
            _insertNode: function (t, n, i, r, o) {
                var a, l, c, u, h = this, f = d(i), p = f.children().length + 1, g = {
                    firstLevel: i.hasClass(W),
                    expanded: !o,
                    length: p
                }, m = "", v = function (e, t) {
                    e.appendTo(t)
                };
                for (c = 0; t.length > c; c++)u = t[c], u.index = n + c, m += h._renderItem({group: g, item: u});
                if (l = e(m), l.length) {
                    for (h.angular("compile", function () {
                        return {
                            elements: l.get(), data: t.map(function (e) {
                                return {dataItem: e}
                            })
                        }
                    }), f.length || (f = e(h._renderGroup({group: g})).appendTo(i)), r(l, f), i.hasClass("k-item") && (s(i), h._updateNodeClasses(i)), h._updateNodeClasses(l.prev().first()), h._updateNodeClasses(l.next().last()), c = 0; t.length > c; c++)u = t[c], u.hasChildren && (a = u.children.data(), a.length && h._insertNode(a, u.index, l.eq(c), v, !h._expanded(l.eq(c))));
                    return l
                }
            },
            _updateNodes: function (t, n) {
                function i(e, t) {
                    e.find(".k-checkbox :checkbox").prop(P, t).data(I, !1).prop(I, !1)
                }

                var r, o, a, s, l, c, d, h = this, f = {treeview: h.options, item: s};
                if ("selected" == n)s = t[0], o = h.findByUid(s.uid).find(".k-in:first").removeClass("k-state-hover").toggleClass("k-state-selected", s[n]).end(), s[n] && h.current(o), o.attr($, !!s[n]); else {
                    for (d = e.map(t, function (e) {
                        return h.findByUid(e.uid).children("div")
                    }), h.angular("cleanup", function () {
                        return {elements: d}
                    }), r = 0; t.length > r; r++)f.item = s = t[r], a = d[r], o = a.parent(), "expanded" != n && "checked" != n && a.children(".k-in").html(h.templates.itemContent(f)), n == P ? (l = s[n], i(a, l), h.options.checkboxes.checkChildren && (i(o.children(".k-group"), l), h._setChecked(s.children, l), h._bubbleIndeterminate(o))) : "expanded" == n ? h._toggle(o, s, s[n]) : "enabled" == n && (o.find(".k-checkbox :checkbox").prop("disabled", !s[n]), c = !u(o).is(j), o.removeAttr(Y), s[n] || (s.selected && s.set("selected", !1), s.expanded && s.set("expanded", !1), c = !0, o.attr($, !1).attr(Y, !0)), h._updateNodeClasses(o, {}, {
                        enabled: s[n],
                        expanded: !c
                    })), a.length && this.trigger("itemChange", {item: a, data: s, ns: g});
                    h.angular("compile", function () {
                        return {
                            elements: d, data: e.map(t, function (e) {
                                return [{dataItem: e}]
                            })
                        }
                    })
                }
            },
            _appendItems: function (e, t, n) {
                var i = d(n), r = i.children(), o = !this._expanded(n);
                typeof e == V && (e = r.length), this._insertNode(t, e, n, function (t, n) {
                    e >= r.length ? t.appendTo(n) : t.insertBefore(r.eq(e))
                }, o), this._expanded(n) && (this._updateNodeClasses(n), d(n).css("display", "block"))
            },
            _refreshChildren: function (e, t, n) {
                var i, r, o, a = this.options, l = a.loadOnDemand, c = a.checkboxes && a.checkboxes.checkChildren;
                if (d(e).empty(), t.length)for (this._appendItems(n, t, e), r = d(e).children(), l && c && this._bubbleIndeterminate(r.last()), i = 0; r.length > i; i++)o = r.eq(i), this.trigger("itemChange", {
                    item: o.children("div"),
                    data: this.dataItem(o),
                    ns: g
                }); else s(e)
            },
            _refreshRoot: function (t) {
                var n, i, r, o = this._renderGroup({items: t, group: {firstLevel: !0, expanded: !0}});
                for (this.root.length ? (this._angularItems("cleanup"), n = e(o), this.root.attr("class", n.attr("class")).html(n.html())) : this.root = this.wrapper.html(o).children("ul"), this.root.attr("role", "tree"), i = 0; t.length > i; i++)r = this.root.children(".k-item"), this.trigger("itemChange", {
                    item: r.eq(i),
                    data: t[i],
                    ns: g
                });
                this._angularItems("compile")
            },
            refresh: function (e) {
                var n, i, r = e.node, o = e.action, a = e.items, s = this.wrapper, l = this.options, c = l.loadOnDemand, d = l.checkboxes && l.checkboxes.checkChildren;
                if (e.field) {
                    if (!a[0] || !a[0].level)return;
                    return this._updateNodes(a, e.field)
                }
                if (r && (s = this.findByUid(r.uid), this._progress(s, !1)), d && "remove" != o) {
                    for (i = !1, n = 0; a.length > n; n++)if ("checked"in a[n]) {
                        i = !0;
                        break
                    }
                    if (!i && r && r.checked)for (n = 0; a.length > n; n++)a[n].checked = !0
                }
                if ("add" == o ? this._appendItems(e.index, a, s) : "remove" == o ? this._remove(this.findByUid(a[0].uid), !1) : "itemchange" == o ? this._updateNodes(a) : "itemloaded" == o ? this._refreshChildren(s, a, e.index) : this._refreshRoot(a), "remove" != o)for (n = 0; a.length > n; n++)(!c || a[n].expanded) && a[n].load();
                this.trigger(O, {node: r ? s : t})
            },
            _error: function (e) {
                var t = e.node && this.findByUid(e.node.uid), n = this.templates.retry({messages: this.options.messages});
                t ? (this._progress(t, !1), this._expanded(t, !1), h(t).addClass("k-i-refresh"), e.node.loaded(!1)) : (this._progress(!1), this.element.html(n))
            },
            _retryRequest: function (e) {
                e.preventDefault(), this.dataSource.fetch()
            },
            expand: function (e) {
                this._processNodes(e, function (e, t) {
                    this.toggle(t, !0)
                })
            },
            collapse: function (e) {
                this._processNodes(e, function (e, t) {
                    this.toggle(t, !1)
                })
            },
            enable: function (e, t) {
                t = 2 == arguments.length ? !!t : !0, this._processNodes(e, function (e, n) {
                    this.dataItem(n).set("enabled", t)
                })
            },
            current: function (n) {
                var i = this, r = i._current, o = i.element, a = i._ariaId;
                return arguments.length > 0 && n && n.length ? (r && (r[0].id === a && r.removeAttr("id"), r.find(".k-in:first").removeClass("k-state-focused")), r = i._current = e(n, o).closest(G), r.find(".k-in:first").addClass("k-state-focused"), a = r[0].id || a, a && (i.wrapper.removeAttr("aria-activedescendant"), r.attr("id", a), i.wrapper.attr("aria-activedescendant", a)), t) : (r || (r = i._nextVisible(e())), r)
            },
            select: function (n) {
                var i = this, r = i.element;
                return arguments.length ? (n = e(n, r).closest(G), r.find(".k-state-selected").each(function () {
                    var t = i.dataItem(this);
                    t ? (t.set("selected", !1), delete t.selected) : e(this).removeClass("k-state-selected")
                }), n.length && i.dataItem(n).set("selected", !0), i.trigger(M), t) : r.find(".k-state-selected").closest(G)
            },
            _toggle: function (e, t, n) {
                var i, r, o = this.options, a = u(e), s = n ? "expand" : "collapse";
                a.data("animating") || this._trigger(s, e) || (this._expanded(e, n), i = t && t.loaded(), r = !a.children().length, !n || i && !r ? (this._updateNodeClasses(e, {}, {expanded: n}), n || a.css("height", a.height()).css("height"), a.kendoStop(!0, !0).kendoAnimate(v({reset: !0}, o.animation[s], {
                    complete: function () {
                        n && a.css("height", "")
                    }
                }))) : (o.loadOnDemand && this._progress(e, !0), a.remove(), t.load()))
            },
            toggle: function (t, n) {
                t = e(t), h(t).is(".k-minus,.k-plus,.k-minus-disabled,.k-plus-disabled") && (1 == arguments.length && (n = !this._expanded(t)), this._expanded(t, n))
            },
            destroy: function () {
                var e = this;
                w.fn.destroy.call(e), e.wrapper.off(C), e._unbindDataSource(), e.dragging && e.dragging.destroy(), p.destroy(e.element), e.root = e.wrapper = e.element = null
            },
            _expanded: function (e, n) {
                var i = p.attr("expanded"), r = this.dataItem(e);
                return 1 == arguments.length ? "true" === e.attr(i) || r && r.expanded : (u(e).data("animating") || (r && (r.set("expanded", n), n = r.expanded), n ? (e.attr(i, "true"), e.attr("aria-expanded", "true")) : (e.removeAttr(i), e.attr("aria-expanded", "false"))), t)
            },
            _progress: function (e, t) {
                var n = this.element, i = this.templates.loading({messages: this.options.messages});
                1 == arguments.length ? (t = e, t ? n.html(i) : n.empty()) : h(e).toggleClass("k-loading", t).removeClass("k-i-refresh")
            },
            text: function (e, n) {
                var i = this.dataItem(e), r = this.options[K.text], o = i.level(), a = r.length, s = r[Math.min(o, a - 1)];
                return n ? (i.set(s, n), t) : i[s]
            },
            _objectOrSelf: function (t) {
                return e(t).closest("[data-role=treeview]").data("kendoTreeView") || this
            },
            _dataSourceMove: function (t, n, i, r) {
                var o, a = this._objectOrSelf(i || n), s = a.dataSource, l = e.Deferred().resolve().promise();
                return i && i[0] != a.element[0] && (o = a.dataItem(i), o.loaded() || (a._progress(i, !0), l = o.load()), i != this.root && (s = o.children, s && s instanceof b || (o._initChildren(), o.loaded(!0), s = o.children))), t = this._toObservableData(t), r.call(this, s, t, l)
            },
            _toObservableData: function (t) {
                var n, i, r = t;
                return (t instanceof window.jQuery || Q(t)) && (n = this._objectOrSelf(t).dataSource, i = e(t).attr(p.attr("uid")), r = n.getByUid(i), r && (r = n.remove(r))), r
            },
            _insert: function (e, t, n) {
                t instanceof p.data.ObservableArray ? t = t.toJSON() : y(t) || (t = [t]);
                var i = e.parent();
                return i && i._initChildren && (i.hasChildren = !0, i._initChildren()), e.splice.apply(e, [n, 0].concat(t)), this.findByUid(e[n].uid)
            },
            insertAfter: o(1),
            insertBefore: o(0),
            append: function (t, n, i) {
                var r = this, o = r.root;
                return n && (o = d(n)), r._dataSourceMove(t, o, n, function (t, o, a) {
                    function s() {
                        n && r._expanded(n, !0);
                        var e = t.data(), i = Math.max(e.length, 0);
                        return r._insert(e, o, i)
                    }

                    var l;
                    return a.then(function () {
                        l = s(), (i = i || e.noop)(l)
                    }), l || null
                })
            },
            _remove: function (t, n) {
                var i, r, o, a = this;
                return t = e(t, a.element), this.angular("cleanup", function () {
                    return {elements: t.get()}
                }), i = t.parent().parent(), r = t.prev(), o = t.next(), t[n ? "detach" : "remove"](), i.hasClass("k-item") && (s(i), a._updateNodeClasses(i)), a._updateNodeClasses(r), a._updateNodeClasses(o), t
            },
            remove: function (e) {
                var t = this.dataItem(e);
                t && this.dataSource.remove(t)
            },
            detach: function (e) {
                return this._remove(e, !0)
            },
            findByText: function (t) {
                return e(this.element).find(".k-in").filter(function (n, i) {
                    return e(i).text() == t
                }).closest(G)
            },
            findByUid: function (t) {
                var n, i, r = this.element.find(".k-item"), o = p.attr("uid");
                for (i = 0; r.length > i; i++)if (r[i].getAttribute(o) == t) {
                    n = r[i];
                    break
                }
                return e(n)
            },
            expandPath: function (n, i) {
                function r(e, t, n) {
                    e && !e.loaded() ? e.set("expanded", !0) : t.call(n)
                }

                var o, a, s;
                for (n = n.slice(0), o = this, a = this.dataSource, s = a.get(n[0]), i = i || e.noop; n.length > 0 && s && (s.expanded || s.loaded());)s.set("expanded", !0), n.shift(), s = a.get(n[0]);
                return n.length ? (a.bind("change", function (e) {
                    var t, s = e.node && e.node.id;
                    s && s === n[0] && (n.shift(), n.length ? (t = a.get(n[0]), r(t, i, o)) : i.call(o))
                }), r(s, i, o), t) : i.call(o)
            },
            _parents: function (e) {
                for (var t = e && e.parentNode(), n = []; t && t.parentNode;)n.push(t), t = t.parentNode();
                return n
            },
            expandTo: function (e) {
                var t, n;
                for (e instanceof p.data.Node || (e = this.dataSource.get(e)), t = this._parents(e), n = 0; t.length > n; n++)t[n].set("expanded", !0)
            },
            _renderItem: function (e) {
                return e.group || (e.group = {}), e.treeview = this.options, e.r = this.templates, this.templates.item(e)
            },
            _renderGroup: function (e) {
                var t = this;
                return e.renderItems = function (e) {
                    var n = "", i = 0, r = e.items, o = r ? r.length : 0, a = e.group;
                    for (a.length = o; o > i; i++)e.group = a, e.item = r[i], e.item.index = i, n += t._renderItem(e);
                    return n
                }, e.r = t.templates, t.templates.group(e)
            }
        }), l.prototype = {
            _removeTouchHover: function () {
                var e = this;
                p.support.touch && e.hovered && (e.hovered.find("." + U).removeClass(U), e.hovered = !1)
            }, _hintStatus: function (n) {
                var i = this._draggable.hint.find(".k-drag-status")[0];
                return n ? (i.className = "k-icon k-drag-status " + n, t) : e.trim(i.className.replace(/k-(icon|drag-status)/g, ""))
            }, dragstart: function (t) {
                var n = this, i = n.treeview, r = n.sourceNode = t.currentTarget.closest(G);
                i.trigger(B, {sourceNode: r[0]}) && t.preventDefault(), n.dropHint = e("<div class='k-drop-hint' />").css(H, "hidden").appendTo(i.element)
            }, drag: function (t) {
                var n, i, r, o, a, s, l, c, d, u, h = this, f = h.treeview, g = h.sourceNode, m = h.dropTarget = e(p.eventTarget(t)), v = m.closest(".k-treeview");
                v.length ? e.contains(g[0], m[0]) ? n = "k-denied" : (n = "k-insert-middle", i = m.closest(".k-top,.k-mid,.k-bot"), i.length ? (o = i.outerHeight(), a = p.getOffset(i).top, s = m.closest(".k-in"), l = o / (s.length > 0 ? 4 : 2), c = a + l > t.y.location, d = t.y.location > a + o - l, h._removeTouchHover(), u = s.length && !c && !d, h.hovered = u ? v : !1, h.dropHint.css(H, u ? "hidden" : "visible"), s.toggleClass(U, u), u ? n = "k-add" : (r = i.position(), r.top += c ? 0 : o, h.dropHint.css(r)[c ? "prependTo" : "appendTo"](m.closest(G).children("div:first")), c && i.hasClass("k-top") && (n = "k-insert-top"), d && i.hasClass("k-bot") && (n = "k-insert-bottom"))) : m[0] != h.dropHint[0] && (n = v[0] != f.element[0] ? "k-add" : "k-denied")) : (n = "k-denied", h._removeTouchHover()), f.trigger(L, {
                    sourceNode: g[0],
                    dropTarget: m[0],
                    pageY: t.y.location,
                    pageX: t.x.location,
                    statusClass: n.substring(2),
                    setStatusClass: function (e) {
                        n = e
                    }
                }), 0 !== n.indexOf("k-insert") && h.dropHint.css(H, "hidden"), h._hintStatus(n)
            }, dragcancel: function () {
                this.dropHint.remove()
            }, dragend: function () {
                function e(e) {
                    a.updateIndeterminate(), a.trigger(F, {
                        sourceNode: e && e[0],
                        destinationNode: n[0],
                        dropPosition: s
                    })
                }

                var n, i, r, o = this, a = o.treeview, s = "over", l = o.sourceNode, c = o.dropHint, d = o.dropTarget;
                return "visible" == c.css(H) ? (s = c.prevAll(".k-in").length > 0 ? "after" : "before", n = c.closest(G)) : d && (n = d.closest(".k-treeview .k-item"), n.length || (n = d.closest(".k-treeview"))), i = {
                    sourceNode: l[0],
                    destinationNode: n[0],
                    valid: "k-denied" != o._hintStatus(),
                    setValid: function (e) {
                        this.valid = e
                    },
                    dropTarget: d[0],
                    dropPosition: s
                }, r = a.trigger(R, i), c.remove(), o._removeTouchHover(), !i.valid || r ? (o._draggable.dropped = i.valid, t) : (o._draggable.dropped = !0, "over" == s ? a.append(l, n, e) : ("before" == s ? l = a.insertBefore(l, n) : "after" == s && (l = a.insertAfter(l, n)), e(l)), t)
            }, destroy: function () {
                this._draggable.destroy()
            }
        }, g.plugin(c)
    }(window.kendo.jQuery), window.kendo
}, "function" == typeof define && define.amd ? define : function (e, t) {
    t()
});