$(document).ready(function() {
    $(".upload-icon").click(function() {
        var input = document.createElement("INPUT");
        input.type = "file";
        input.accept = "image/*";
        input.click();
        input.onchange = function() {
            var file = new FormData();
            file.append("data", this.files[0]);
            $.ajax({
                type: "POST",
                url: "php/upload.php",
                data: file,
                contentType: false,
                processData: false,
                cache: false,
                xhr: function() {
                    var request = new XMLHttpRequest();
                    request.upload.onprogress = function(e) {
                        var loaded = (e.loaded / 1024 / 1024).toFixed(2);
                        var total = (e.total / 1024 / 1024).toFixed(2);
                        var percentage = (loaded * 100) / total;
                        $(".progress-control").css({
                            width: percentage + "%"
                        });
                        $(".progress-percentage").html(percentage + "%" + " " + loaded + "MB / " + total + "MB");
                    }
                    return request;
                },
                beforeSend: function() {
                    $(".upload-header").html("Please Wait...");
                    $(".upload-icon").css({
                        opacity: "0.5",
                        pointerEvents: "none",
                    });
                    $(".upload-progress-con").removeClass("d-none");
                    $(".progress-details").removeClass("d-none");
                },
                success: function(response) {


                    var message = document.createElement("DIV");
                    message.className = "alert alert-light shadow-lg py-3 rounded-0";
                    message.innerHTML = "<b>" + response + "</b>";
                    $(".upload-notice").html(message);
                    // alert(response);
                    setTimeout(function() {
                        $(".upload-header").html("UPLOADED FILE");
                        $(".upload-icon").css({
                            opacity: "1",
                            pointerEvents: "auto",
                        });
                        $(".upload-progress-con").addClass("d-none");
                        $(".progress-details").addClass("d-none");
                        $(".upload-notice").html("");
                    }, 3000);


                    $.ajax({
                        type: "POST",
                        url: "php/count_photo.php",
                        cache: false,
                        beforeSend: function() {
                            $(".count_photo").html("Updating...");
                        },
                        success: function(response) {
                            $(".count_photo").html(response);

                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "php/memory.php",
                        cache: false,
                        beforeSend: function() {
                            $(".memory-status").html("Updating...");
                            $(".free_space").html("Updating...");
                        },
                        success: function(response) {
                            var json_parse = JSON.parse(response);
                            var plans = json_parse[0];
                            if (plans == 'exclusive') {

                                var memory_status = json_parse[1];
                                $(".memory-status").html("USED STORAGE : " + memory_status);
                                $(".free_space").html("FREE SPACE : UNLIMITED");
                            } else {

                                var memory_status = json_parse[1];
                                var free_memory = json_parse[2];
                                var percentage = json_parse[3] + "%";
                                $(".memory-status").html(memory_status);

                                $(".free_space").html("FREE SPACE : " + free_memory + "MB");
                                $(".memory-progress").css("width", percentage);


                            }
                        }
                    });
                }
            });
        }
    });
});