/* global $ */

var IFramework = {

	defaultParam: function(param, defaultValue) {

		return (typeof param !== 'undefined') ? param : defaultValue;

	},

	select: function(selector) {
		return document.querySelector(selector);
	},

	selectAll: function(selector) {
		return document.querySelectorAll(selector);
	},

	find: function(element, selector) {
		return element.querySelector(selector);
	},

	findAll: function(element, selector) {
		return element.querySelectorAll(selector);
	}

};

IFramework.FormatHelper = {

	cleanOutput: function (str) {
		return str.replace(/./gm, function(s) {
			return '&#' + s.charCodeAt(0) + ';';
		});
	}

};

IFramework.Config = {

	webUrl: 'http://tienda.igara.local/',
	prettyUrl: true,
	sectionRequest: 'p',
	subsectionSeparator: '/',
	
};

IFramework.Ajax = {

	request: function(config) {

		config.method = IFramework.defaultParam(config.method.toUpperCase(), IFramework.defaultParam(config.type.toUpperCase(), 'GET'));
		config.url = IFramework.defaultParam(config.url, '');
		config.async = IFramework.defaultParam(config.async, true);
		config.data = IFramework.defaultParam(config.data, null);

		config.success = IFramework.defaultParam(config.success, function(){});
		config.error = IFramework.defaultParam(config.error, function(){});

		// If data is object
		if (typeof config.data === 'object') {
			var serialized = '';
			for (var key in config.data) {
				if (serialized != '') serialized += '&';
				serialized += key + '=' + config.data[key];
			}
			config.data = serialized;
		}

		// GET + data
		if (config.method.toUpperCase() == 'GET' && config.data != null) {
			config.url += (config.url.indexOf('?') > -1) ? '&' : '?';
			config.url += config.data;
		}

		var request = new XMLHttpRequest();
		request.open(config.method, config.url, config.async);

		request.addEventListener('error', config.error);
		request.addEventListener('load', function(){

			if (request.status >= 200 && request.status < 400) {
				config.success(request.responseText);
			} else {
				config.error();
			}

		});

		if (config.data != null) {
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			request.send(config.data);
		} else {
			request.send();
		}

	},

	handleForm: function(form, before, after) {

		before = IFramework.defaultParam(before, function(){});
		after = IFramework.defaultParam(after, function(){});

		form.data('disabled', false);

		form.submit(function (e) {

			e.preventDefault();

			if (before() != false && !form.data('disabled')) {

				form.data('disabled', true);

				$.ajax({
					type: form.attr('method'),
					url: form.attr('action'),
					data: form.serialize(),
					success: function(data) {
						form.data('disabled', false);
						after(data);
					},
					error: function() {
						form.data('disabled', false);
						after(null);
					}
				});

			}

		});

	}

};

IFramework.Navigation = {

	getSectionName: function(sections) {

		return sections.join('/');

	},

	getLink: function(pages) {

		if (IFramework.Config.prettyUrl) {
			return IFramework.Config.webUrl + this.getSectionName(pages);
		} else {
			return IFramework.Config.webUrl + '?p=' + this.getSectionName(pages);
		}

	},

	redirect: function(url, milliseconds) {

		milliseconds = IFramework.defaultParam(milliseconds, 0);

		setTimeout(function() {
			window.location.href = url;
		}, milliseconds);

	},

	redirectPage: function(pages, milliseconds) {

		milliseconds = IFramework.defaultParam(milliseconds, 0);

		IFramework.Navigation.redirect(IFramework.Navigation.getLink(pages), milliseconds);

	}

};

IFramework.Api = {

	getCaptchaImageRestrictor: false,
	getCaptcha: function (callback) {

		callback = IFramework.defaultParam(callback, function(){});

		if (!IFramework.Api.getCaptchaImageRestrictor) {

			IFramework.Api.getCaptchaImageRestrictor = true;

			$.ajax({
				method: 'POST',
				url: IFramework.Navigation.getLink(['api', 'auth', 'captcha']),
				success: function(data) {
					IFramework.Api.getCaptchaImageRestrictor = false;
					callback(data);
				},
				error: function() {
					IFramework.Api.getCaptchaImageRestrictor = false;
				}
			});

		}
	}

};

/* No JQuery Required */
IFramework.Animation = {

	onCSSAnimationEnd: function (element, callback) {

		var s = document.body.style || document.documentElement.style;

		var prefix = '';
		if (s.WebkitAnimation === '') prefix = '-webkit-';
		else if (s.MozAnimation === '') prefix = '-moz-';
		else if (s.OAnimation === '') prefix = '-o-';
		else if (s.MsAnimation === '') prefix = '-ms-';

		var runOnce = function(ev) {
			callback();
			ev.target.removeEventListener(ev.type, runOnce);
		};

		element.addEventListener('webkitAnimationEnd', runOnce);
		element.addEventListener('mozAnimationEnd', runOnce);
		element.addEventListener('oAnimationEnd', runOnce);
		element.addEventListener('MSAnimationEnd', runOnce);
		element.addEventListener('animationend', runOnce);

		if (
			(prefix === '' && !('animation' in s)) ||
			getComputedStyle(element)[prefix + 'animation-duration'] === '0s'
		) {
			callback();
		}

		return element;

	},

	onCSSTransitionEnd: function (element, callback) {

		var s = document.body.style || document.documentElement.style;

		var prefix = '';
		if (s.WebkitTransition === '') prefix = '-webkit-';
		else if (s.MozTransition === '') prefix = '-moz-';
		else if (s.OTransition === '') prefix = '-o-';
		else if (s.MsTransition === '') prefix = '-ms-';

		var runOnce = function(ev) {
			callback();
			ev.target.removeEventListener(ev.type, runOnce);
		};

		element.addEventListener('webkitTransitionEnd', runOnce);
		element.addEventListener('mozTransitionEnd', runOnce);
		element.addEventListener('oTransitionEnd', runOnce);
		element.addEventListener('msTransitionEnd', runOnce);
		element.addEventListener('transitionend', runOnce);
		if (
			(prefix === '' && !('transition' in s)) ||
			getComputedStyle(element)[prefix + 'transition-duration'] === '0s'
		) {
			callback();
		}

		return element;

	}

};

/* No JQuery Required */
IFramework.Modal = {

	modalElement: null,

	show: function (content) {

		var modalElement = document.createElement('div');
		modalElement.classList.add('modal');

		var modalContent = document.createElement('div');
		modalContent.classList.add('modalContent');

		var modalContentClose = document.createElement('div');
		modalContentClose.classList.add('modalClose');
		modalContentClose.innerHTML = '<i class="fa fa-times" aria-hidden="true"></i>';
		modalContentClose.onclick = function() {
			IFramework.Modal.close(modalElement);
		};

		var modalContentHtml = document.createElement('div');
		modalContentHtml.classList.add('modalContentHtml');
		modalContentHtml.innerHTML = content;

		modalContent.appendChild(modalContentClose);
		modalContent.appendChild(modalContentHtml);
		modalElement.appendChild(modalContent);

		document.body.appendChild(modalElement);

		window.getComputedStyle(modalElement);

		modalElement.onclick = function(event) {
			if (event.target == modalElement) {
				IFramework.Modal.close(modalElement);
			}
		};

		IFramework.Modal.modalElement = modalElement;
		return modalContentHtml;

	},

	close: function(modal) {

		modal = modal || IFramework.Modal.modalElement;
		modal.style.opacity = 0;
		IFramework.Animation.onCSSTransitionEnd(modal, function() {
			modal.parentElement.removeChild(modal);
		});

	}

};

/* No JQuery Required */
IFramework.Alert = {

	add: function(container, style, content, timeout) {

		if (container !== null) {

			style = IFramework.defaultParam(style, 'success');
			content = IFramework.defaultParam(content, '');
			timeout = IFramework.defaultParam(timeout, 4250);

			var el = document.createElement('div');
			el.classList.add('alert');
			el.classList.add(style);
			el.dataset.timeout = timeout;
			el.innerHTML = content;

			container.append(el);

			IFramework.Alert.showElement($(el));

		}

	},

	showElement: function(element) {

		if (element !== null) {

			element.click(function(){
				IFramework.Alert.hideElement(element);
			});

			element.slideDown(300);

			var timeout = IFramework.defaultParam(element[0].dataset.timeout, 4250);
			if (timeout > 0) setTimeout(function(){
				IFramework.Alert.hideElement(element);
			}, timeout);

		}

	},

	hideElement: function(element) {

		if (element !== null) {

			element.slideUp(300, function() {
				IFramework.Alert.deleteElement(element);
			});

		}

	},

	deleteElement: function(element) {

		if (element !== null) {
			element.remove();
			//element.parentElement.removeChild(element);
		}

	}

};