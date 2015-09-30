define('zfegg/model/view', ['jquery', 'kendo'], function($, kendo) {
    var View = function (tmpl, renderOptions, render) {
        this.options = {
            tmpl: tmpl,
            render: render,
            renderOptions: renderOptions
        };
    };

    View.prototype.render = function (onRender) {
        var opts = this.options;
        var self = this;

        $.get(opts.tmpl, function (html){
            var view = new kendo.View(html, opts.renderOptions);
            var elem = view.render();
            self.kendoView = view;
            onRender && onRender(elem, view);
            opts.render && opts.render(elem, view);
        });
    };

    return View;
});