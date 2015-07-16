@if ( ! $api->hasRated() )

    var uri = "{{ url('/widget/' . $api->widget->id ) }}";

    // load css
    function re_load_css( file ) {
        var css_ref = document.createElement("link");
        css_ref.setAttribute("rel", "stylesheet");
        css_ref.setAttribute("type", "text/css");
        css_ref.setAttribute("href", file);
        document.getElementsByTagName("head")[0].appendChild(css_ref);
    }
    re_load_css("{{ asset('/css/api.css') }}");

    var html = '';

    @if ( $api->widget->widgetType->name == "feedback" )

        html = '<form id="re-review-widget-form" name="re-review-widget-form" class="re-review-widget-form-feedback">\
                    <div class="re-review-widget-container" id="re-review-widget-container">\
                        <div class="re-review-widget-controller re-review-widget-has-header">\
                            <div class="re-review-widget-controller-header">\
                                <span class="re-review-widget-icon re-review-widget-icon-positive re-review-widget-submit" id="re-review-rating-1" data-rating="1"><i class="fa fa-check"></i></span>\
                                <span class="re-review-widget-icon re-review-widget-icon-negative" id="re-review-rating-2" data-rating="2"><i class="fa fa-remove"></i></span>\
                            </div>\
                        </div>\
                        <div class="re-review-widget-feedback" id="re-review-widget-feedback-toggle" style="display: none">\
                            <textarea name="text" id="re-review-widget-feedback-val" placeholder="Was können wir verbessern?"></textarea>\
                            <button type="submit" class="re-review-widget-submit">senden</button>\
                        </div>\
                    </div>\
                    <input type="hidden" name="_token" id="review-widget-token" value="{{ csrf_token() }}">\
                    <input type="hidden" name="rating" id="re-review-widget-rating-val" value="" />\
                </form>\
        ';

        var org = document.getElementById("re-review-widget");
        org.innerHTML = html;

        // Toggle textarea
        document.getElementById("re-review-rating-2").onclick = function() {
            document.getElementById("re-review-widget-feedback-toggle").style.display = '';
        };

    @elseif ( $api->widget->widgetType->name == "thumb" )

        html = '<form id="re-review-widget-form" name="re-review-widget-form" class="re-review-widget-form-thumb">\
            <div class="re-review-widget-container" id="re-review-widget-container">\
                <div class="re-review-widget-controller re-review-widget-has-header">\
                    <div class="re-review-widget-controller-header">\
                        <h5>Wie gefällt dir diese Seite?</h5>\
                    </div>\
                    <div class="re-review-widget-controller-content">\
                        <span class="re-review-widget-icon re-review-widget-submit" id="re-review-rating-1" data-rating="1"><i class="fa fa-thumbs-o-up"></i></span>\
                        <span class="re-review-widget-icon re-review-widget-submit" id="re-review-rating-2" data-rating="2"><i class="fa fa-thumbs-o-up"></i></span>\
                        <span class="re-review-widget-icon re-review-widget-submit" id="re-review-rating-3" data-rating="3"><i class="fa fa-thumbs-o-down"></i></span>\
                    </div>\
                </div>\
            </div>\
            <input type="hidden" name="_token" id="review-widget-token" value="{{ csrf_token() }}">\
            <input type="hidden" name="rating" id="re-review-widget-rating-val" value="" />\
        </form>\
        ';

        var org = document.getElementById("re-review-widget");
        org.innerHTML = html;

    @elseif ( $api->widget->widgetType->name == "star" )

        html = '<form id="re-review-widget-form" name="re-review-widget-form" class="re-review-widget-form-star">\
            <div class="re-review-widget-container" id="re-review-widget-container">\
                <div class="re-review-widget-controller re-review-widget-has-header">\
                    <div class="re-review-widget-controller-header">\
                        <h5>Wie gefällt dir diese Seite?</h5>\
                    </div>\
                    <div class="re-review-widget-controller-content">\
                        <span class="re-review-widget-icon re-review-widget-submit" id="re-review-rating-1" data-rating="1"></span>\
                        <span class="re-review-widget-icon re-review-widget-submit" id="re-review-rating-2" data-rating="2"></span>\
                        <span class="re-review-widget-icon re-review-widget-submit" id="re-review-rating-3" data-rating="3"></span>\
                        <span class="re-review-widget-icon re-review-widget-submit" id="re-review-rating-4" data-rating="4"></span>\
                        <span class="re-review-widget-icon re-review-widget-submit" id="re-review-rating-5" data-rating="5"></span>\
                    </div>\
                </div>\
            </div>\
            <input type="hidden" name="_token" id="review-widget-token" value="{{ csrf_token() }}">\
            <input type="hidden" name="rating" id="re-review-widget-rating-val" value="" />\
        </form>\
        ';

        var org = document.getElementById("re-review-widget");
        org.innerHTML = html;

    @endif

    // On Rating click
    var listeners = document.getElementsByClassName("re-review-widget-icon");

    var onRating = function() {
        document.getElementById("re-review-widget-rating-val").value = this.getAttribute('data-rating');
    };

    for(var i=0;i<listeners.length;i++) {
        listeners[i].addEventListener('click', onRating, false);
    }

    function reFormSubmit(form) {

        var http = new XMLHttpRequest();
        var url = uri + "/rate";

        var params = "";
        for (var i = 0, ii = form.length; i < ii; ++i) {
            var input = form[i];
            if (input.name) {
                params += "&" + input.name + "=" + input.value;
            }
        }

        params = params.substring(1);

        http.open("POST", url, true);

        //Send the proper header information along with the request
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        http.onreadystatechange = function() {

            if(http.readyState == 4 && http.status == 200) {

                var returned = JSON.parse(http.responseText);
                if ( returned.success ) {

                    // Hide widget and show notice
                    document.getElementById("re-review-widget-container").style.display = 'none';

                    if ( returned.message ) {

                        var msg_div = document.createElement("div");
                        msg_div.innerHTML = returned.message;
                        msg_div.className = 're-review-widget-notice';
                        document.getElementById("re-review-widget-form").appendChild(msg_div);

                    }

                } else {

                }

            } else {

                // Error

            }

        }

        http.send(params);

    }

    // On Submit click
    var submit_listeners = document.getElementsByClassName("re-review-widget-submit");

    var onSubmit = function(e) {
        reFormSubmit(document.forms["re-review-widget-form"]);
        e.preventDefault();
        return false;
    };

    for(var i=0;i<submit_listeners.length;i++) {
        submit_listeners[i].addEventListener('click', onSubmit, false);
    }

@endif