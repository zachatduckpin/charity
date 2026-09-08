/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */
"use strict";
function notify(type, message) {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
  Toast.fire({
    icon: type,
    title: message,
  });
}

(function ($) {
  "use strict"; // Start of use strict

  $(".hide-close").on("click", function () {
    $(this).parent().remove();
  });

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on("click", function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $(".sidebar .collapse").collapse("hide");
    }
  });

  $("#wrapper .sidebar a").each(function () {
    var pageUrl = window.location.href.split(/[#]/)[0];
    if (this.href == pageUrl) {
      if ($(this).parent().hasClass("collapse-inner")) {
        $(this).addClass("active"); // add active to li of the current link
        $(this).parent().parent().parent().addClass("active");
        $(this).parent().parent().prev().click();
      } else {
        $(this).parent().addClass("active"); // add active to li of the current link
      }
    }
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function () {
    if ($(window).width() < 768) {
      $(".sidebar .collapse").collapse("hide");
    }
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $("body.fixed-nav .sidebar").on(
    "mousewheel DOMMouseScroll wheel",
    function (e) {
      if ($(window).width() > 768) {
        var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
      }
    }
  );

  // Scroll to top button appear
  $(document).on("scroll", function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $(".scroll-to-top").fadeIn();
    } else {
      $(".scroll-to-top").fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on("click", "a.scroll-to-top", function (e) {
    var $anchor = $(this);
    $("html, body")
      .stop()
      .animate(
        {
          scrollTop: $($anchor.attr("href")).offset().top,
        },
        1000,
        "easeInOutExpo"
      );
    e.preventDefault();
  });

  // IMAGE UPLOADING :)
  $(document).on("change", ".image", function (event) {
    var file = event.target.files[0];
    var target = $(this).attr("data-target");
    var path = $("#image" + target);
    var reader = new FileReader();
    reader.onload = function (e) {
      path.attr("src", e.target.result);
    };
    reader.readAsDataURL(file);
  });

  // IMAGE UPLOADING ENDS :)

  // POPUP MODAL
  $(".confirm-modal").on("show.bs.modal", function (e) {
    $(this).find(".btn-ok").attr("href", $(e.relatedTarget).data("href"));
  });

  $(".confirm-modal .btn-ok").on("click", function (e) {
    if (admin_loader == 1) {
      $(".submit-loader").show();
    }

    $.ajax({
      type: "GET",
      url: $(this).attr("href"),
      success: function (data) {
        $(".confirm-modal").modal("hide");
        table.ajax.reload();
        $(".alert-danger").hide();
        $(".alert-success").show();
        $(".alert-success p").html(data);

        if (admin_loader == 1) {
          $(".submit-loader").hide();
        }
      },
    });
    return false;
  });

  // POPUP MODAL ENDS

  // Delete Operation ------------------------------------------//

  $("#confirm-delete").on("show.bs.modal", function (e) {
    $(this)
      .find("#remove__data")
      .attr("action", $(e.relatedTarget).data("href"));
  });

  // Delete Operation End ------------------------------------------//

  // All Image Reader -----------------------------//

  $(document).on("change", ".image,#image", function () {
    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
      // console.log(e.target.result)
      $(".ShowImage").removeClass("d-none");
      $(".ShowImage img").attr("src", e.target.result);
    };
    reader.readAsDataURL(file);
  });
  // All Image Reader -----------------------------//

  // meta tags js

  $(document).on("click", "#seo", function () {
    if ($(this).is(":checked")) {
      $(".showbox").removeClass("d-none");
    } else {
      $(".showbox").addClass("d-none");
    }
  });

  $(document).ready(function () {
    if ($("#seo").is(":checked")) {
      $(".showbox").removeClass("d-none");
    } else {
      $(".showbox").addClass("d-none");
    }
  });
})(jQuery); // End of use strict





// Modal Javascript

$(document).ready(function () {
  $("#myBtn").click(function () {
    $(".modal").modal("show");
  });

  $("#modalLong").click(function () {
    $(".modal").modal("show");
  });

  $("#modalScroll").click(function () {
    $(".modal").modal("show");
  });

  $("#modalCenter").click(function () {
    $(".modal").modal("show");
  });
});

// Popover Javascript

$(function () {
  $('[data-toggle="popover"]').popover();
});

$(".popover-dismiss").popover({
  trigger: "focus",
});

function shownotification() {
  $("#notclear").html("0");
  $route = $("#notclear").data("href");
  $.get($route);
  $("#notf-show").load($("#notf-show").data("href"));
}

$(document).on("click", "#clear-notf", function () {
  $.get($(this).data("href"));
});

// Status Start
$(document).on("click", ".status", function () {
  var link = $(this).attr("data-href");
  $.get(link, function () {}).done(function (data) {
    table.ajax.reload();
    $(".alert-danger").hide();
    $(".alert-success").show();
    $(".alert-success p").html(data);
  });
});
// Status Ends

// FORM SUBMIT AJAX
$(document).on("submit", "#geniusform,#geniusformUpdate", function (e) {
  var $this = $(this);

  e.preventDefault();

  $("#submit-btn").prop("disabled", true);

  $.ajax({
    method: "POST",
    url: $(this).prop("action"),
    data: new FormData(this),
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      if (data.errors) {
        $this.find(".alert-success").hide();
        $this.find(".alert-danger").show();
        $this.find(".alert-danger ul").html("");
        for (var error in data.errors) {
          $this
            .find(".alert-danger ul")
            .append("<li>" + data.errors[error] + "</li>");
          notify("error", data.errors[error]);
        }
      } else {
        $this.find(".alert-danger").hide();
        $this.find(".alert-success").show();
        $this.find(".alert-success p").html(data);
        if ($this.attr("id") != "geniusformUpdate") {
          $("#geniusform")[0].reset();
        }
        notify("success", data);
      }
      if (admin_loader == 1) {
        $(".gocover").hide();
      }
      $("#submit-btn").prop("disabled", false);
      $(window).scrollTop(0);
    },
  });
});

$(".icon-picker").iconpicker({
  search: true,
});

// EMAIL CHECK JS START
$(document).on("change", "#mail_type", function () {
  let is_type = $(this).val();
  if (is_type == "php_mail") {
    $(".smtp__check").addClass("d-none");
  } else {
    $(".smtp__check").removeClass("d-none");
  }
});
// EMAIL CHECK JS END

// LANGUAGE JS START

function isEmpty(el) {
  return !$.trim(el.html());
}

$(document).on("click", ".remove-btn", function () {
  $(this.parentNode).remove();
  if (isEmpty($("#language-section"))) {
    $("#language-section").append(
      ` <div class="language-area  position-relative">
            <span class="remove-btn"><i class="fas fa-times"></i></span>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-6">
                    <div class="form-group ">
                        <textarea name="keys[]" class="form-control" placeholder="Enter Language Key" required=""></textarea>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-6">
                    
                    <div class="form-group ">
                        <textarea name="values[]" class="form-control" placeholder="Enter Language Value" required=""></textarea>
                    </div>
                </div>
            </div>
        </div>`
    );
  }
});
// LANGUAGE JS END

$(document).on("click", ".addToMenu", function () {
  let $this = $(this);
  let title = $this.data("title");
  let keyword = title.replace(/[^a-z0-9\s]/gi, "").replace(/[_\s]/g, "-");
  let dropdown = $this.data("dropdown");
  let href = $this.data("href");
  let target = $this.data("target");

  $("#section-list").append(`
            <div class="card mb-0 mt-2 mx-2 draggable-item">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mb-1 mt-0">${title}</h5>
                            <input type="hidden" name="${keyword}[title]" value="${title}">
                            <input type="hidden" name="${keyword}[dropdown]" value="${dropdown}">
                            <input type="hidden" name="${keyword}[href]" value="${href}">
                            <input type="hidden" name="${keyword}[target]" value="${target}">
                        </div>
                        <i class="remove-menu fa fa-trash-alt"></i>
                    </div>
                </div>
            </div>
        `);
});

$(document).on("click", "#custom-submit", function () {
  alert("0");
  let title = $("#title").val();
  let href = $("#url").val();
  if (
    /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(
      href
    )
  ) {
    href = href;
    $(".show__url__validation").hide();
  } else {
    $(".show__url__validation").show();
    return true;
  }

  if (title != "") {
    let keyword = title.replace(/[^a-z0-9\s]/gi, "").replace(/[_\s]/g, "-");
    let dropdown = "no";

    let target = $("#target").val();

    $("#section-list").append(`
                <div class="card mb-0 mt-2 mx-2 draggable-item">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h5 class="mb-1 mt-0">${title}</h5>
                                <input type="hidden" name="${keyword}[title]" value="${title}">
                                <input type="hidden" name="${keyword}[dropdown]" value="${dropdown}">
                                <input type="hidden" name="${keyword}[href]" value="${href}">
                                <input type="hidden" name="${keyword}[target]" value="${target}">
                            </div>
                            <i class="remove-menu fa fa-trash-alt"></i>
                        </div>
                    </div>
                </div>
            `);
  }
});

$(document).on("click", ".remove-menu", function () {
  $(this).parent().parent().parent().remove();
});

// Sorting Section
if ($("#section-list").length > 0) {
  var el = document.getElementById("section-list");
  Sortable.create(el, {
    animation: 100,
    group: "list-1",
    draggable: ".draggable-item",
    handle: ".draggable-item",
    sort: true,
    filter: ".sortable-disabled",
    chosenClass: "active",
  });
}

$(document).on("click", "#campaign_faq_checkbox", function () {
  var faqFormView = $(".faq_form_view");

  if ($(this).is(":checked")) {
    faqFormView.fadeIn("slow", function () {
      // Remove 'd-none' class after fadeIn is complete
      faqFormView.removeClass("d-none");
    });
  } else {
    faqFormView.fadeOut("slow", function () {
      faqFormView.addClass("d-none");
    });
  }
});

$(document).on("click", ".add_more_btn", function () {
  let faq_title = $("#showing_faq_form").attr("faq-title");
  let faq_content = $("#showing_faq_form").attr("faq-content");
  let html = `<div class="row d-flex justify-content-center align-items-center mb-4 mb-md-0 border py-4 rounded-lg">
        <div class="col-md-44 col-sm-122 col-12">
            <div class="form-group">
                <label for="faq_title">${faq_title}</label>
                <input type="text" class="form-control" name="faq_title[]" id="faq_title" required
                    placeholder="${faq_title}" value="">
            </div>
        </div>
        <div class="col-md-66 col-sm-122 col-12">
            <div class="form-group">
                <label for="faq_content">${faq_content}</label>
                <textarea type="number" step="any" class="form-control" name="faq_content[]"
                    id="faq_content" placeholder="${faq_content}"></textarea>
            </div>
        </div>
        <div class="col-md-22 col-sm-122 col-12">
            <div class="">
                <button type="button" class="btn btn-danger btn-sm remove_faq text-capitalize">
                remove
                </button>
            </div>
        </div>
    </div>`;

  $("#showing_faq_form").append(html);
});

$(document).on("click", ".remove_faq", function () {
  $(this).parent().parent().parent().remove();
});

$(document).on("click", ".removeGallery", function () {
  var imageName = $(this).parent().find("img").attr("data-name");
  var files = $("#upload_gallery_image")[0].files;
  var updatedFiles = Array.from(files).filter(function (file) {
    return file.name !== imageName;
  });

  var dataTransfer = new DataTransfer();
  updatedFiles.forEach(function (file) {
    dataTransfer.items.add(file);
  });

  $("#upload_gallery_image")[0].files = dataTransfer.files;

  // Remove the parent container of the removed image
  $(this).parent().parent().remove();
});

$(document).on("change", "#upload_gallery_image", function (event) {
  let html = "";
  for (let i = 0; i < event.target.files.length; i++) {
    html += `
        <div class="col-6 col-sm-4 my-3">
      <figure class="imagecheck-figure gelllabsoluteposition-relative">
      <span class="badge badge-danger gelllabsolute removeGallery"><i
              class="fas fa-times"></i></span>
      <img data-name="${event.target.files[i].name}" src="${URL.createObjectURL(
      event.target.files[i]
    )}"
          alt="}" class="imagecheck-image">
      </figure>
    </div>`;
  }
  $("#view_gallery_images").append(html);
});

$(document).on("click", ".removeGalleryPermanent", function () {
  let url = $(this).attr("data-href");
  let $this = $(this);
  $.get(url, function (res) {
    if (res.success) {
      notify("success", res.success);
      $this.parent().parent().remove();
    }
  });
});

$(document).on("change", "#event_type", function () {
  let type = $(this).val();
  if (type == "offline") {
    $(".event_location").removeClass("d-none");
    $(".event_link").addClass("d-none");
    $("#event_location").attr("required", true);
    $("#event_link").attr("required",false);
  } else {
    $(".event_location").addClass("d-none");
    $("#event_location").attr("required", false);
    $("#event_link").attr("required",true);
    $(".event_link").removeClass("d-none");
  }
});
