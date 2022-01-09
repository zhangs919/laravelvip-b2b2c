//if (!$.isFunction($.fn.modal)) {
/*
 * ======================================================================== Bootstrap: modal.js v3.3.5 http://getbootstrap.com/javascript/#modals ======================================================================== Copyright 2011-2015 Twitter, Inc. Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE) ========================================================================
 */

+function($) {
	'use strict';

	// MODAL CLASS DEFINITION
	// ======================

	var Modal = function(element, options) {
		this.options = options;
		this.$body = $(document.body);
		this.$element = $(element);
		this.$dialog = this.$element.find('.modal-dialog');
		this.$backdrop = null;
		this.isShown = null;
		this.originalBodyPad = null;
		this.scrollbarWidth = 0;
		this.ignoreBackdropClick = false;

		if (this.options.remote) {
			this.$element.find('.modal-content').load(this.options.remote, $.proxy(function() {
				this.$element.trigger('loaded.bs.modal')
			}, this))
		}
	}

	Modal.VERSION = '3.3.5';

	Modal.TRANSITION_DURATION = 300;
	Modal.BACKDROP_TRANSITION_DURATION = 150;

	Modal.DEFAULTS = {
		backdrop: true,
		keyboard: true,
		show: true
	}

	Modal.prototype.toggle = function(_relatedTarget) {
		return this.isShown ? this.hide() : this.show(_relatedTarget)
	}

	Modal.prototype.show = function(_relatedTarget) {
		var that = this;
		var e = $.Event('show.bs.modal', {
			relatedTarget: _relatedTarget
		});

		this.$element.trigger(e);

		if (this.isShown || e.isDefaultPrevented()) {
			return;
		}

		this.isShown = true;

		this.checkScrollbar();
		this.setScrollbar();
		this.$body.addClass('modal-open');

		this.escape();
		this.resize();

		this.$element.on('click.dismiss.bs.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this));

		this.$dialog.on('mousedown.dismiss.bs.modal', function() {
			that.$element.one('mouseup.dismiss.bs.modal', function(e) {
				if ($(e.target).is(that.$element)) {
					that.ignoreBackdropClick = true;
				}
			})
		})

		this.backdrop(function() {
			var transition = $.support.transition && that.$element.hasClass('fade');

			if (!that.$element.parent().length) {
				// don't move modals dom position
				try {
					that.$body.append(that.$element);
				} catch (e) {
					console.error(e);
				}

			}

			that.$element.show().scrollTop(0);

			that.adjustDialog();

			if (transition) {
				that.$element[0].offsetWidth; // force reflow
			}

			that.$element.addClass('in');

			that.enforceFocus();

			var e = $.Event('shown.bs.modal', {
				relatedTarget: _relatedTarget
			});

			transition ? that.$dialog // wait for modal to slide in
			.one('bsTransitionEnd', function() {
				that.$element.trigger('focus').trigger(e);
			}).emulateTransitionEnd(Modal.TRANSITION_DURATION) : that.$element.trigger('focus').trigger(e)
		})
	}

	Modal.prototype.hide = function(e) {
		if (e) {
			e.preventDefault();
		}

		e = $.Event('hide.bs.modal');

		this.$element.trigger(e);

		if (!this.isShown || e.isDefaultPrevented()) {
			return;
		}

		this.isShown = false;

		this.escape();
		this.resize();

		$(document).off('focusin.bs.modal');

		this.$element.removeClass('in').off('click.dismiss.bs.modal').off('mouseup.dismiss.bs.modal');

		this.$dialog.off('mousedown.dismiss.bs.modal');

		$.support.transition && this.$element.hasClass('fade') ? this.$element.one('bsTransitionEnd', $.proxy(this.hideModal, this)).emulateTransitionEnd(Modal.TRANSITION_DURATION) : this.hideModal();
	}

	Modal.prototype.enforceFocus = function() {
		$(document).off('focusin.bs.modal').on('focusin.bs.modal', $.proxy(function(e) {
			if (this.$element[0] !== e.target && !this.$element.has(e.target).length) {
				this.$element.trigger('');
			}
		}, this))
	}

	Modal.prototype.escape = function() {
		if (this.isShown && this.options.keyboard) {
			this.$element.on('keydown.dismiss.bs.modal', $.proxy(function(e) {
				e.which == 27 && this.hide();
			}, this))
		} else if (!this.isShown) {
			this.$element.off('keydown.dismiss.bs.modal')
		}
	}

	Modal.prototype.resize = function() {
		if (this.isShown) {
			$(window).on('resize.bs.modal', $.proxy(this.handleUpdate, this));
		} else {
			$(window).off('resize.bs.modal');
		}
	}

	Modal.prototype.hideModal = function() {
		var that = this;
		this.$element.hide();
		this.backdrop(function() {
			that.$body.removeClass('modal-open');
			that.resetAdjustments();
			that.resetScrollbar();
			that.$element.trigger('hidden.bs.modal');
		})
	}

	Modal.prototype.removeBackdrop = function() {
		this.$backdrop && this.$backdrop.remove();
		this.$backdrop = null;
	}

	Modal.prototype.backdrop = function(callback) {
		var that = this;
		var animate = this.$element.hasClass('fade') ? 'fade' : '';

		if (this.isShown && this.options.backdrop) {
			var doAnimate = $.support.transition && animate;

			this.$backdrop = $(document.createElement('div')).addClass('modal-backdrop ' + animate).appendTo(this.$body);

			this.$element.on('click.dismiss.bs.modal', $.proxy(function(e) {
				if (this.ignoreBackdropClick) {
					this.ignoreBackdropClick = false;
					return;
				}
				if (e.target !== e.currentTarget) {
					return;
				}
				this.options.backdrop == 'static' ? this.$element[0].focus() : this.hide();
			}, this))

			if (doAnimate) {
				this.$backdrop[0].offsetWidth;
			}

			this.$backdrop.addClass('in');

			if (!callback) {
				return;
			}

			doAnimate ? this.$backdrop.one('bsTransitionEnd', callback).emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) : callback();

		} else if (!this.isShown && this.$backdrop) {
			this.$backdrop.removeClass('in');

			var callbackRemove = function() {
				that.removeBackdrop();
				callback && callback();
			}
			$.support.transition && this.$element.hasClass('fade') ? this.$backdrop.one('bsTransitionEnd', callbackRemove).emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) : callbackRemove();

		} else if (callback) {
			callback();
		}
	}

	// these following methods are used to handle overflowing modals

	Modal.prototype.handleUpdate = function() {
		this.adjustDialog();
	}

	Modal.prototype.adjustDialog = function() {
		var modalIsOverflowing = this.$element[0].scrollHeight > document.documentElement.clientHeight;

		this.$element.css({
			paddingLeft: !this.bodyIsOverflowing && modalIsOverflowing ? this.scrollbarWidth : '',
			paddingRight: this.bodyIsOverflowing && !modalIsOverflowing ? this.scrollbarWidth : ''
		})
	}

	Modal.prototype.resetAdjustments = function() {
		this.$element.css({
			paddingLeft: '',
			paddingRight: ''
		})
	}

	Modal.prototype.checkScrollbar = function() {
		var fullWindowWidth = window.innerWidth;
		// workaround for missing window.innerWidth in IE8
		if (!fullWindowWidth) {
			var documentElementRect = document.documentElement.getBoundingClientRect();
			fullWindowWidth = documentElementRect.right - Math.abs(documentElementRect.left);
		}
		this.bodyIsOverflowing = document.body.clientWidth < fullWindowWidth;
		this.scrollbarWidth = this.measureScrollbar();
	}

	Modal.prototype.setScrollbar = function() {
		var bodyPad = parseInt((this.$body.css('padding-right') || 0), 10);
		this.originalBodyPad = document.body.style.paddingRight || '';
		if (this.bodyIsOverflowing) {
			this.$body.css('padding-right', bodyPad + this.scrollbarWidth);
		}
	}

	Modal.prototype.resetScrollbar = function() {
		this.$body.css('padding-right', this.originalBodyPad);
	}

	Modal.prototype.measureScrollbar = function() { // thx walsh
		var scrollDiv = document.createElement('div');
		scrollDiv.className = 'modal-scrollbar-measure';
		this.$body.append(scrollDiv);
		var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
		this.$body[0].removeChild(scrollDiv);
		return scrollbarWidth;
	}

	// MODAL PLUGIN DEFINITION
	// =======================

	function Plugin(option, _relatedTarget) {
		return this.each(function() {
			var $this = $(this);
			var data = $this.data('bs.modal');
			var options = $.extend({}, Modal.DEFAULTS, $this.data(), typeof option == 'object' && option);

			if (!data) {
				$this.data('bs.modal', (data = new Modal(this, options)));
			}

			if (typeof option == 'string') {
				data[option](_relatedTarget);
			} else if (options.show) {
				data.show(_relatedTarget);
			}
		})
	}

	var old = $.fn.modal;

	$.fn.modal = Plugin;
	$.fn.modal.Constructor = Modal;

	// MODAL NO CONFLICT
	// =================

	$.fn.modal.noConflict = function() {
		$.fn.modal = old;
		return this;
	}

	// MODAL DATA-API
	// ==============

	$(document).on('click.bs.modal.data-api', '[data-toggle="modal"]', function(e) {
		var $this = $(this);
		var href = $this.attr('href');
		var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))); // strip
		// for ie7
		var option = $target.data('bs.modal') ? 'toggle' : $.extend({
			remote: !/#/.test(href) && href
		}, $target.data(), $this.data());

		if ($this.is('a')) {
			e.preventDefault();
		}

		$target.one('show.bs.modal', function(showEvent) {
			if (showEvent.isDefaultPrevented()) {
				return;
			}
			$target.one('hidden.bs.modal', function() {
				$this.is(':visible') && $this.trigger('focus');
			})
		})
		Plugin.call($target, option, this);
	})

}(jQuery);
// }

(function($) {

	var lastUuid = 0;

	var uuid = function() {
		return (new Date()).getTime() * 1000 + (lastUuid++) % 1000;
	}

	var modal_list = [];

	/**
	 * 
	 * @param options
	 *            要么为jquery对象，要么为配置参数
	 */
	$.modal = function(options) {

		if (options instanceof jQuery) {
			var element = options;

			if ($(element).hasClass(".modal")) {
				return $(element).data('szy.modal');
			} else if ($(element).parents(".modal").size() > 0) {
				return $(element).parents(".modal").data('szy.modal');
			} else {
				return $(element).data('szy.modal');
			}
		}

		if (options == 'hide') {
			for (var i = 0; i < modal_list.length; i++) {
				var modal = modal_list[i];
				$(modal).modal("hide");
			}
			return;
		}

		var defaults = {
			id: uuid(),
			title: false,
			content: '',
			footer: false,
			width: false,
			height: false,
			buttons: false,
			// 用于存放一些交互用的数据
			params: {},
			ajax: false,
			// 触发器，会在触发器的data中存放modal
			trigger: false,
			// 在调用 show 方法后触发。
			onshow: null,
			// 当调用 hide 实例方法时触发。
			onhide: null,
			load: function() {
				if (this.ajax == false) {
					return this.content;
				}

				var options = this;

				return $.ajax({
					url: this.ajax.url,
					type: this.ajax.method,
					async: true,
					dataType: "json",
					data: this.ajax.data
				}).done(function(result) {
					if (result.code == 0) {
						options.content = result.data;
					} else {
						$.msg(result.message, {
							time: 5000
						});
					}
				});
			},
			// 渲染页面
			render: function(content) {

				this.content = content;

				var html = '<div id="' + this.id + '" class="modal fade" tabindex="-1" role="dialog">';
				html += '<div class="modal-dialog">';
				html += '<div class="modal-content">';
				if (this.title != false) {
					html += '<div class="modal-header">';
					html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
					html += '<h5 class="modal-title">';
					html += this.title;
					html += '</h5>';
					html += '</div>';
				}
				html += '<div class="modal-body">';
				html += this.content;
				html += '</div>';
				if (this.footer != false) {
					html += '<div class="modal-footer">';
					// html += '<input type="button" value="确定" class="btn
					// btn-primary"
					// />';
					// html += '<input type="button" value="取消" class="btn
					// btn-default"
					// data-dismiss="modal" />';
					html += '</div>';
				}
				html += '</div>';
				html += '</div>';
				html += '</div>';

				this.container = $(html);

				// 放在这里避免IE9报错
				$(this.container).data('szy.modal', this);
				if (this.trigger) {
					$(this.trigger).data('szy.modal', this);
				}

				this.container.modal("toggle");

				// var Modal = $(this.container).data('bs.modal');
				// Modal = $.extend(true, Modal, this);

				var Modal = $(this.container).data('bs.modal');

				if (this.width != false) {
					$(this.container).find(".modal-dialog").width(this.width);
				}
				if (this.height != false) {
					$(this.container).find(".modal-dialog").height(this.height);
				}

				// 设置宽度
				this.width = function(width) {
					// $(this.container).find(".modal-dialog").animate({width:
					// width}, 300);
					if (width != undefined) {
						$(this.container).find(".modal-dialog").width(width);
					} else {
						return $(this.container).find(".modal-dialog").width();
					}
				};

				// 设置高度
				this.height = function(height) {
					if (height != undefined) {
						$(this.container).find(".modal-dialog").height(height);
					} else {
						return $(this.container).find(".modal-dialog").height();
					}
				};

				this.title = function(title) {
					if (title != undefined) {
						if ($(this.container).find(".modal-title").size() == 0) {
							var html = '<div class="modal-header">';
							html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
							html += '<h5 class="modal-title">';
							html += title;
							html += '</h5>';
							html += '</div>';
							$(this.container).find(".modal-content").prepend(html);
						} else {
							$(this.container).find(".modal-title").html(title);
						}
					} else {
						return $(this.container).find(".modal-title").html();
					}
				};

				// 设置内容
				this.content = function(content) {
					if (content != undefined) {
						$(this.container).find(".modal-body").html(content);
					} else {
						return $(this.container).find(".modal-body").html();
					}
				};

				// 点击切换显示隐藏
				this.toggle = function() {
					if ($(this.container).is(":hidden")) {
						$(this.container).modal("show");
					} else {
						$(this.container).modal("hide");
					}
				};

				// // 显示
				this.show = function() {
					$(this.container).modal("show");
				};

				// 隐藏
				this.hide = function() {
					$(this.container).modal("hide");
				};

				// 显示移除底部按钮栏
				this.footer = function(show) {
					if (show == true) {
						if ($(this.container).find(".modal-footer").size() == 0) {
							$(this.container).find(".modal-body").after('<div class="modal-footer"></div>');
						}
					} else if (show == false) {
						$(this.container).find(".modal-footer").remove();
					}
				}

				// 关闭销毁
				this.close = function() {
					// $(this.container).modal("hide");
					$(this.container).data('szy.modal', null);
					if (this.trigger) {
						$(this.trigger).data('szy.modal', null);
					}
					var container = this.container;
					// $(this.container).on('hidden.bs.modal', function() {
					// $(container).parents(".modal").remove();
					// $(".modal-backdrop").remove();
					// })
					// $(this.container).modal("hide");
					$("#" + this.id).remove();

				}

				// 移除按钮
				this.removeButton = function(id) {
					id = "modal_" + this.id + "_" + id;
					$(this.container).find(".modal-footer").find("#" + id).remove();
				}

				// 添加或者查询一个按钮
				this.addButton = function(options) {
					var modal = this;

					var defaults = {
						// 按钮
						id: 'btn_' + uuid(),
						// 按钮显示的文字
						text: 'Button',
						// 按钮的样式
						btn_class: 'btn btn-primary',
						// 按钮点击事件
						click: function(event) {
							modal.hide();
						}
					};

					options = $.extend(true, defaults, options);

					if ($(this.container).find(".modal-footer").size() == 0) {
						$(this.container).find(".modal-body").after('<div class="modal-footer"></div>');
					}

					var element = $(this.container).find(".modal-footer").find("[id='" + options.id + "']");

					if ($(element).size() == 0) {
						element = $('<input type="button" id="modal_' + this.id + '_' + options.id + '" value="' + options.text + '" class="' + options.btn_class + '"/>');
						$(this.container).find(".modal-footer").append(element);
					} else {
						$(element).val(options.text);
						$(element).attr("class", options.btn_class);
					}

					if ($.isFunction(options.click)) {
						$(element).click(function(event) {
							options.click.call(modal, event);
						});
					}

					return $(element);

				}

				if (this.buttons != false && $.isArray(this.buttons)) {
					for (var i = 0; i < this.buttons.length; i++) {
						var element = this.addButton(this.buttons[i]);
						this.buttons[i].id = $(element).attr("id");
						this.buttons[i].btn_class = $(element).attr("class");
						this.buttons[i].object = element;
					}
				} else {
					this.buttons = [];
				}

				if ($.isFunction(this.onshow)) {
					var options = this;
					$(this.container).on("show.bs.modal", function() {
						options.onshow.call(options);
					});
				}

				// 绑定事件
				var settings = this;

				$(this.container).on("hide.bs.modal", function() {
					if ($.isFunction(settings.onhide)) {
						settings.onhide.call(settings);
					}
					if (settings.trigger == undefined || settings.trigger == null || settings.trigger == false) {
						settings.close();
					}
				});

				$(this.container).find(".modal-hide").click(function() {
					settings.hide();
				});
				$(this.container).find(".modal-close").click(function() {
					settings.close();
				});

				$(document).off('focusin.modal');

				modal_list.push($(this.container));
			}
		};

		options = $.extend(true, defaults, options);

		if (options.ajax != false) {
			return options.load().done(function(result) {
				if (result.code == 0) {
					options.render(options.content);
				}
			});
		} else {
			options.render(options.content);
		}

		return options;
	};

})(jQuery);