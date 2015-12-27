define(["jquery","../utils","../keys"],function(e,t,n){function r(e,t){this.$element=e,this.options=t,r.__super__.constructor.call(this)}return t.Extend(r,t.Observable),r.prototype.render=function(){var t=e('<span class="select2-selection" role="combobox"  aria-haspopup="true" aria-expanded="false"></span>');return this._tabindex=0,this.$element.data("old-tabindex")!=null?this._tabindex=this.$element.data("old-tabindex"):this.$element.attr("tabindex")!=null&&(this._tabindex=this.$element.attr("tabindex")),t.attr("title",this.$element.attr("title")),t.attr("tabindex",this._tabindex),this.$selection=t,t},r.prototype.bind=function(e,t){var r=this,i=e.id+"-container",s=e.id+"-results";this.container=e,this.$selection.on("focus",function(e){r.trigger("focus",e)}),this.$selection.on("blur",function(e){r._handleBlur(e)}),this.$selection.on("keydown",function(e){r.trigger("keypress",e),e.which===n.SPACE&&e.preventDefault()}),e.on("results:focus",function(e){r.$selection.attr("aria-activedescendant",e.data._resultId)}),e.on("selection:update",function(e){r.update(e.data)}),e.on("open",function(){r.$selection.attr("aria-expanded","true"),r.$selection.attr("aria-owns",s),r._attachCloseHandler(e)}),e.on("close",function(){r.$selection.attr("aria-expanded","false"),r.$selection.removeAttr("aria-activedescendant"),r.$selection.removeAttr("aria-owns"),r.$selection.focus(),r._detachCloseHandler(e)}),e.on("enable",function(){r.$selection.attr("tabindex",r._tabindex)}),e.on("disable",function(){r.$selection.attr("tabindex","-1")})},r.prototype._handleBlur=function(t){var n=this;window.setTimeout(function(){if(document.activeElement==n.$selection[0]||e.contains(n.$selection[0],document.activeElement))return;n.trigger("blur",t)},1)},r.prototype._attachCloseHandler=function(t){var n=this;e(document.body).on("mousedown.select2."+t.id,function(t){var n=e(t.target),r=n.closest(".select2"),i=e(".select2.select2-container--open");i.each(function(){var t=e(this);if(this==r[0])return;var n=t.data("element");n.select2("close")})})},r.prototype._detachCloseHandler=function(t){e(document.body).off("mousedown.select2."+t.id)},r.prototype.position=function(e,t){var n=t.find(".selection");n.append(e)},r.prototype.destroy=function(){this._detachCloseHandler(this.container)},r.prototype.update=function(e){throw new Error("The `update` method must be defined in child classes.")},r});