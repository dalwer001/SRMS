<script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.js"></script>
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }

</script>
<script>
    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if (h == 0) {
            h = 12;
        }

        if (h > 12) {
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("myClockDisplay").innerText = time;
        document.getElementById("myClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();

    /Date jd function/

    var today = new Date();
    var dd = today.getDate();

    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }
    today = dd + '-' + mm + '-' + yyyy;

    document.getElementById("myDateDisplay").innerHTML = today;

</script>
<script>
    function myFunction(imgs) {
        var expandImg = document.getElementById("expandedImg");
        var imgText = document.getElementById("imgtext");
        expandImg.src = imgs.src;
        imgText.innerHTML = imgs.alt;
        expandImg.parentElement.style.display = "block";
    }

</script>
@stack('customer_js')
