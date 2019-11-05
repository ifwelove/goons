<script src="{{ URL::asset('assets/js/vendor.min.js') }}"></script>

@yield('script')

<script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
<script>
    var now_url = window.location.href;
    var array = now_url.split("/");
    var my_item_index = array.length - 1;

    if (array[my_item_index] == 'layouts-sidebar-sm') {
        document.body.setAttribute('class', '');
        document.body.classList.add('left-side-menu-sm');
    } else if (array[my_item_index] == 'layouts-dark-sidebar') {
        document.body.setAttribute('class', '');
        document.body.classList.add('left-side-menu-dark');
    } else if (array[my_item_index] == 'layouts-light-topbar') {
        document.body.setAttribute('class', '');
        document.body.classList.add('left-side-menu-dark');
        document.body.classList.add('topbar-light');
    } else if (array[my_item_index] == 'layouts-sidebar-collapsed') {
        document.body.setAttribute('class', '');
        document.body.classList.add('enlarged');
    } else if (array[my_item_index] == 'layouts-boxed') {
        document.body.setAttribute('class', '');
        document.body.classList.add('enlarged');
        document.body.classList.add('boxed-layout');
    } else {

    }

    function preloader_fun() {
        document.getElementById("if_need_loader").style.display = "block";
        document.getElementById("preloader").style.display = "block";
        document.getElementById("status").style.display = "block";
        setTimeout(function () {
            document.getElementById("if_need_loader").style.display = "none";
        }, 1500);
    }

    $(document).ready(function () {
        var idleState = false;
        var idleTimer = null;

        $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
            clearTimeout(idleTimer);

            if (idleState == true) {
                // $("body").css('background-color','#fff');
            }

            idleState = false;
            idleTimer = setTimeout(function () {
                // $("body").css('background-color','#000');
                // $('#timeOutModal').modal('show');
                idleState = true;
            }, 5000);
        });

        $("body").trigger("mousemove");

        $('#clientSearch').keyup(function (e) {
            e.preventDefault();

            var text = this.value;

            $("#clientList .inbox-item:not(:contains('" + text + "'))").css('display', 'none');
            $("#clientList .inbox-item:contains('" + text + "')").css('display', 'block');
        });
    });
</script>

@yield('script-bottom')
