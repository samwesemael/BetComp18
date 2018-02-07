<?php include 'navigator.php';?>
<script type="text/javascript">
    document.getElementById("nav-extra").classList.toggle('active');
	document.getElementById("nav-chat").classList.toggle('active');
</script>
    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" type="text/css" href="../css/chatbox.css">
    
    <script>
        String.prototype.trim = function() {
            return this.replace(/^\s+|\s+$/g,"");
            
        }

        function enter_comment(event) {
               if (event.which == 13 && document.getElementById("msg").value.trim != '') {
                    alert(document.getElementById("msg").value);
                    submitChat(); // Call any function here: Just pass your actual Parameters to enter_comment().
               }

        }

        function submitChat(){
            $('#chatlogs').scrollTop($('#chatlogs')[0].scrollHeight);
            if(form.msg.value == ""){
                alert('FIELD SHOULD BE FILLED IN!!');
                return;
            }
            var msg = form.msg.value;
            var uname = '<?php echo $_SESSION['username'];?>';
            $('#loading').show();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert('here');
                    $('#loading').hide();
                    document.getElementById('chatlogs').innerHTML = xhttp.responseText;
                    $('#chatlogs').scrollTop($('#chatlogs')[0].scrollHeight);
                }
            }
            
            xhttp.open('GET', 'chatinsert.php?uname='+uname+'&msg='+msg, true);
            xhttp.send();
            // alert('done');
        }
        $(document).ready(function(e){
            $.ajaxSetup({
                cache: false
            });

            setInterval( function(){ $('#chatlogs').load('chatlogs.php'); }, 2000 );
        });

    </script>

    <section class="content">

        <div class="chatbox">
            <div id='loading' class='loading' style="display:none">
                loading..
            </div>
            <div class="chatlogs" id="chatlogs">
                <!-- <div class="chat friend">
                    <div class="user-photo img-circle"><img src="../images/users/sam.jpg"></div>
                    <p class="chat-message">Test..!!!</p>
                </div>
                <div class="chat self">
                    <div class="user-photo"><img src="../images/users/aaron.jpg"></div>
                    <p class="chat-message">I here you..!!!</p>
                </div>
                <div class="chat friend">
                    <div class="user-photo img-circle"><img src="../images/users/sam.jpg"></div>
                    <p class="chat-message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris a dui at tellus pulvinar consectetur. Donec nec ante tempor, tincidunt nisl vel, volutpat massa. Ut porttitor ornare rutrum. Curabitur suscipit tempus sapien, in tristique lorem dignissim nec. Mauris auctor vestibulum est id eleifend. Sed rhoncus urna sit amet eleifend iaculis. Suspendisse vitae fermentum tellus.</p>
                </div> -->
            </div>
            <form name="form">
                <div class="chat-form">
                    <textarea name="msg" id="msg" placeholder="Write a comment here..." onkeyup="enter_comment(event);"></textarea>
                    <a onclick="submitChat()">Send</a> 
                </div>
            </form>

        </div>
    </section>



    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
</body>

</html>