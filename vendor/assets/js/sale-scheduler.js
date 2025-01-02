jQuery(document).ready(($) => {
  const regularPrice = parseFloat($("#_regular_price").val());
  const scheduleContainer = $("#schedule_container");
  const addScheduleButton = $("#add-schedule");

  function toggleRemoveButtons() {
    const childrenCount = scheduleContainer.children().length;
    $(".remove_sale").toggle(childrenCount > 1);
  }

  toggleRemoveButtons();
  scheduleContainer.find(".start-date, .end-date").each(function () {
    const element = $(this);
    const isStartDateField = element.hasClass("start-date");
    const fieldSibling = isStartDateField ? ".end-date" : ".start-date";
    const dateLimit = isStartDateField ? { dateFormat: "yy-mm-dd", minDate: element.val() } :
      { dateFormat: "yy-mm-dd", maxDate: element.val() };
    if (element.val()) {
      element.siblings(fieldSibling).datepicker(dateLimit);
    }
  });

  scheduleContainer.on("focus change", ".start-date, .end-date", function () {
    const isStartDateField = $(this).hasClass("start-date");
    const startDateField = isStartDateField ? $(this) : $(this).siblings(".start-date");
    const endDateField = isStartDateField ? $(this).siblings(".end-date") : $(this);

    startDateField.datepicker({
      dateFormat: "yy-mm-dd",
      onSelect: function (selectedDate) { ;
        endDateField.datepicker("option", "minDate", selectedDate);
      }
    });
    endDateField.datepicker({ 
      dateFormat: "yy-mm-dd",
      onSelect: function (selectedDate) { 
        startDateField.datepicker("option", "maxDate", selectedDate);
      }
    });
  });

  addScheduleButton.on("click", () => {
    const clone = $(".schedule-pricing-fields").first().clone();
    clone.find("input").val("");
    clone.find(".remove_sale").show();
    scheduleContainer.append(clone);
    toggleRemoveButtons();
    
    $(".start-date, .end-date").removeClass("hasDatepicker");
    $(".start-date, .end-date").attr("id", "");
  });

  scheduleContainer.on("click", ".remove_sale", (e) => {
    e.preventDefault();
    if ( scheduleContainer.children().length > 1 ) {
      $(e.currentTarget).closest(".schedule-pricing-fields").remove();
      toggleRemoveButtons();
    }
  });

  scheduleContainer.on("keyup change", ".schedule-sale-price", function() {
    const salePrice = parseFloat($(this).val());
    // To remove the custom validation message set by the "focusout" event.
    $(this)[0].setCustomValidity("");

    if ( salePrice >= regularPrice ) {
      $( document.body ).triggerHandler( "wc_add_error_tip", [
        $( this ),
        "i18n_sale_less_than_regular_error",
      ] );
    } else {
      $( document.body ).triggerHandler( "wc_remove_error_tip",
        [ $( this ),
        "i18n_sale_less_than_regular_error" ]
      );
    }
  });

  scheduleContainer.on("focusout", ".schedule-sale-price", function() {
    const salePrice = parseFloat($(this).val());
    if ( !salePrice ) {
      return;	
    }
    if ( salePrice < 0 ) {
      $(this).val("");
      $(this)[0].setCustomValidity("Please enter a price greater than 0.");
      $(this)[0].reportValidity();
    } else if ( salePrice >= regularPrice ) {
      $(this).val("");
    } else {
      $(this).val(parseFloat(salePrice).toFixed(2));
    }
  });
});