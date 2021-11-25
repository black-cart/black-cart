(function() {
  // global vars
  var hotSpotWidth = 30;
  var spotId = 0;
  var form = $('#toolTipGenerator .form-config-product-build');
  var image = $('#toolTipGenerator #preview_image_spot');
  var image_size = {};
  var hotSpots = [];
  
  var selectedSpot;
  var moving = false;

  init();
  /// tạo sự kiện change value in input hidden
  function init() {
    disableForm();
    formActions();
    $(image).on('mousedown', function(e) {
      if($(e.target).hasClass('t_hotSpot')) {
        hotSpots[$(e.target).attr('id').replace('t_hotspot_', '')].select();
        resetFormValue();
      }else {
        if(selectedSpot) {
          selectedSpot.deselect();
        }
      }
    });
    $('#t_addSpot').on('click', function(e) {
      image_size.w = Math.ceil(image.width());
      image_size.h = Math.ceil(image.height());
      drawHotSpot(e);
      hotSpots[hotSpots.length - 1].select();
      resetFormValue();
    });
  }
  function resetFormValue() {
    $('#t_spotType option').removeAttr('selected');
    $('#t_spotType').val(selectedSpot.settings['t_spotType']);

    $('#t_spotSize option').removeAttr('selected');
    $('#t_spotSize').val(selectedSpot.settings['t_spotSize']);

    $('#t_spotColor option').removeAttr('selected');
    $('#t_spotColor').val(selectedSpot.settings['t_spotColor']);

    $('#t_popupPosition option').removeAttr('selected');
    $('#t_popupPosition').val(selectedSpot.settings['t_popupPosition']);

    $('#t_change_content_type option').removeAttr('selected');
    $('#t_change_content_type').val(selectedSpot.settings['t_content_type']);
    $('#t_change_content_type').trigger('change');

    $('#t_spotType').selectpicker('refresh')
    $('#t_spotSize').selectpicker('refresh')
    $('#t_spotColor').selectpicker('refresh')
    $('#t_popupPosition').selectpicker('refresh')
    $('#t_change_content_type').selectpicker('refresh')

    $('#t_toolTipWidth').val(selectedSpot.settings['t_toolTipWidth']);
    $('#t_toolTipWidthAuto').prop('checked', selectedSpot.settings['t_toolTipWidthAuto']);
    $('#t_toolTipVisible').prop('checked', selectedSpot.settings['t_toolTipVisible']);

    if (selectedSpot.settings['t_content_type'] == 'product') {
      $('#productBuild option').removeAttr('selected');
      $('#productBuild').val(selectedSpot.settings['t_product']);
      $('#productBuild').selectpicker('refresh');
    }
  }
  function drawHotSpot(e) {
    var relativeToImageTop = $(image).height() / 2;
    var relativeToImageLeft = $(image).width() / 2;
    var hotSpot = new HotSpot(relativeToImageLeft, relativeToImageTop, $(image));
    hotSpot.init();
    hotSpots.push(hotSpot);
  }
  function disableForm() {
    $(form).find('input, select, textarea, button').attr('disabled', 'disabled');
  }
  function enableForm() {
    $(form).find('input, select, textarea, button').removeAttr('disabled').removeClass('disabled');
  }
  function applySettingToSpot(id) {
    $('#' + id).on('change', function() {
      if (selectedSpot) {
        selectedSpot.settings[id] = $(this).val();
        selectedSpot.applySettings();
      }
    });
  }
  function formActions() {
    applySettingToSpot('t_spotType');
    applySettingToSpot('t_spotSize');
    applySettingToSpot('t_spotColor');
    $('#t_toolTipWidth').on('change', function() {
      if (selectedSpot) {
          if($('#t_toolTipWidthAuto')[0].checked) {
            $('#t_toolTipWidthAuto').click();
          }
        selectedSpot.settings['t_toolTipWidth'] = parseInt($(this).val());
        selectedSpot.applySettings();
      }
    });
    $('#t_toolTipWidthAuto').on('change', function() {
      if (selectedSpot) {
          if($(this)[0].checked) {
            selectedSpot.settings['t_toolTipWidthAuto'] = true;
          } else {
            selectedSpot.settings['t_toolTipWidthAuto'] = false;
          }
        selectedSpot.applySettings();
      }
    });
    $('#t_toolTipVisible').on('change', function() {
      if (selectedSpot) {
          if($(this)[0].checked) {
            selectedSpot.settings['t_toolTipVisible'] = true;
          } else {
            selectedSpot.settings['t_toolTipVisible'] = false;
          }
        selectedSpot.applySettings();
      }
    });
    applySettingToSpot('t_popupPosition');
    applySettingToSpot('t_content');

    CKEDITOR.instances.t_content_text.on('key', function(evt) {
        if (selectedSpot) {
            selectedSpot.settings['t_content'] = CKEDITOR.instances.t_content_text.getData();
          selectedSpot.applySettings();
        }
    });

    $('#t_deleteSpot').on('click', function() {
      if (selectedSpot) {
        selectedSpot.delete();
      }
    });

    $('#t_change_content_type').on('change', function() {
      var val = $(this).val();
      $('.content_type').hide();
      $('#content_type_'+val).show();
      if (selectedSpot) {
          selectedSpot.settings['t_content_type'] = val;
          if (val == 'text') {
            selectedSpot.settings['t_product'] = '';
          }
          selectedSpot.applySettings();
      }

    });

    $('#productBuild').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
      var name = $('option:selected', this).attr("data-tokens");
      var image = $('option:selected', this).attr("data-image");
      var id = $(this).val();
      var html = '<div><img src="'+image+'"><h4>'+name+'</h4></div>';
      if (selectedSpot) {
          selectedSpot.settings['t_content'] = html;
          selectedSpot.settings['t_product'] = id;
          selectedSpot.applySettings();
          $('.t_product_'+hotSpots.indexOf(selectedSpot)).val(id);
      }
    });

  }
  function applySpotSettingsToForm() {
    var settings = selectedSpot.settings;
    
    for(var i in settings) {
      $('#' + i).val(settings[i]);
    }
    if(selectedSpot.settings['t_toolTipWidthAuto']) {
      $('#t_toolTipWidthAuto').attr('checked', 'checked');
    } else {
      $('#t_toolTipWidthAuto').removeAttr('checked');
    }
  }
  
  function HotSpot(x, y, parent,setting = null) {
    this.parent = parent;
    this.id = spotId;
    this.x = x;
    this.y = y; 
    this.html = '<div class="t_hotSpot" id="t_hotspot_'+this.id+'"><div class="t_tooltip_content_wrap"><div class="t_tooltip_content"></div></div></div>';
    this.root = '';
    this.inset = '';
    
    this.settings = { "t_spotType" : "circle"
                     ,  "t_spotSize" : "small"
                     ,  "t_spotColor" : "white"
                     ,  "t_popupPosition" : "left"
                     ,  "t_toolTipVisible" : false
                     , "t_content_type" : ""
                     , "t_content" : ""
                     , "t_toolTipWidth" : 200
                     , "t_toolTipWidthAuto" : true 
                     , "t_product" : ""
                    };

      this.input = '<input type="hidden" name="hotSpots['+this.id+'][spot_type]" value="'+this.settings.t_spotType+'" class="t_spotType" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_size]" value="'+this.settings.t_spotSize+'" class="t_spotSize" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_color]" value="'+this.settings.t_spotColor+'" class="t_spotColor" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_popup_position]" value="'+this.settings.t_popupPosition+'" class="t_popupPosition" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_tooltip_visible]" value="'+this.settings.t_toolTipVisible+'" class="t_toolTipVisible" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_content_type]" value="'+this.settings.t_content_type+'" class="t_content_type" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_content]" value="'+ this.settings.t_content+'" class="t_content" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_tooltip_width]" value="'+this.settings.t_toolTipWidth+'" class="t_toolTipWidth" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_tooltip_width_auto]" value="'+this.settings.t_toolTipWidthAuto+'" class="t_toolTipWidthAuto" >';
      this.input += '<input type="hidden" name="hotSpots['+this.id+'][product_id]" value="'+this.settings.t_product+'" class="t_product" >';

      if(setting != null){
        this.settings['t_spotType'] = setting.spot_type;
        this.settings['t_spotSize'] = setting.spot_size;
        this.settings['t_spotColor'] = setting.spot_color;
        this.settings['t_popupPosition'] = setting.spot_popup_position;
        this.settings['t_toolTipVisible'] = (setting.spot_tooltip_visible === 'true');
        this.settings['t_content_type'] = setting.spot_content_type;
        this.settings['t_content'] = setting.spot_content;
        this.settings['t_toolTipWidth'] = setting.spot_tooltip_width;
        this.settings['t_toolTipWidthAuto'] = (setting.spot_tooltip_width_auto === 'true');
        this.settings['t_product'] = setting.product_id;
        var ins = $.parseJSON(setting.spot_inset);
        var t = ins.top;
        var l = ins.left; 
        this.input += "<input type='hidden' name='hotSpots["+this.id+"][spot_inset]' class='t_inset' value='{\"top\":\""+t+"\",\"left\":\""+l+"\"}'>";
      }else{
        this.input += '<input type="hidden" name="hotSpots['+this.id+'][spot_inset]" class="t_inset">';
      }
    spotId++;
    
  }
  
  
  
   HotSpot.prototype.init = function() {
    this.parent.append(this.html);
    this.root = $('#t_hotspot_' + this.id).draggable(
      { containment: "parent",
        stop:function(e,ui) {
          var imw = (image_size.length ? image_size.w : $(image).width());
          var imh = (image_size.length ? image_size.h : $(image).height());
          var l = ( 100 * parseFloat(ui.position.left / parseFloat(imw) )) + "%" ;
          var t = ( 100 * parseFloat(ui.position.top / parseFloat(imh) )) + "%" ;
          $(e.target).find('.t_inset').val('{"top": "'+t+'","left":"'+l+'"}');
        }
    });
    
    this.root.append(this.input);

    this.root.css({ "left" : this.x, "top" : this.y});

    this.applySettings();
    console.log(this.settings);
  };

  HotSpot.prototype.select = function() {
    $('.t_hotSpot.selected').removeClass('selected');
    this.root.addClass('selected');
    
    this.root.find('.t_tooltip_content_wrap').css({opacity: 1});
    selectedSpot = this;
    applySpotSettingsToForm();
    enableForm();
  };
  HotSpot.prototype.deselect = function() {
    $('.t_hotSpot.selected').removeClass('selected');
    
    this.root.find('.t_tooltip_content_wrap').css("opacity", "");

    selectedSpot = null;
    disableForm();
  };
  HotSpot.prototype.delete = function() {
    this.deselect();
    this.root.remove();

    hotSpots[this.id] = null;
  };
  
  HotSpot.prototype.applySettings = function() {
    this.root.removeClass('circle').removeClass('square').removeClass('circleOutline').removeClass('squareOutline') .removeClass('small').removeClass('medium').removeClass('large') .removeClass('white').removeClass('black').removeClass('red').removeClass('green').removeClass('blue').removeClass('purple').removeClass('pink').removeClass('orange')
    ;
    
    var wrap = this.root.find('.t_tooltip_content_wrap');
    wrap.removeClass('top').removeClass('left').removeClass('bottom').removeClass('right');
                                                                                                                                                                                                                                                                                                                                                                                                              
    
    this.root.addClass(this.settings['t_spotType']);
    this.root.addClass(this.settings['t_spotSize']);
    this.root.addClass(this.settings['t_spotColor']);
    wrap.addClass(this.settings['t_popupPosition']);
    wrap.find('.t_tooltip_content').html(this.settings['t_content']);
    
    wrap.removeClass('alwaysVisible');
    if(this.settings['t_toolTipVisible']) {
      wrap.addClass('alwaysVisible')
    }

    if (!this.settings['t_toolTipWidthAuto']) {
      wrap.css({ 'width' : this.settings['t_toolTipWidth'] }).addClass('specificWidth');
    } else {
      wrap.css({ 'width' : 'auto' }).removeClass('specificWidth');
    }
    $(this.root).find('.t_spotType').val(this.settings['t_spotType']);
    $(this.root).find('.t_spotSize').val(this.settings['t_spotSize']);
    $(this.root).find('.t_spotColor').val(this.settings['t_spotColor']);
    $(this.root).find('.t_popupPosition').val(this.settings['t_popupPosition']);
    $(this.root).find('.t_toolTipVisible').val(this.settings['t_toolTipVisible']);
    $(this.root).find('.t_content_type').val(this.settings['t_content_type']);
    $(this.root).find('.t_content').val(this.settings['t_content']);
    $(this.root).find('.t_toolTipWidth').val(this.settings['t_toolTipWidth']);
    $(this.root).find('.t_toolTipWidthAuto').val(this.settings['t_toolTipWidthAuto']);
    $(this.root).find('.t_product').val(this.settings['t_product']);

  };
  if ($('#old_hotSpots').length) {
    $('#toolTipGenerator').find('.form-config-product-build').removeClass('hidden');

    $.each($.parseJSON($('#old_hotSpots').val()), function(index, val) {
      var ins = $.parseJSON(val.spot_inset);
      var t = ins.top.replace('%','');
      var l = ins.left.replace('%','');
      var relativeToImageLeft = parseFloat($(image).width()) * (parseFloat(l) / 100);
      var relativeToImageTop =  parseFloat($(image).height()) * (parseFloat(t) / 100);
      var hotSpot = new HotSpot(relativeToImageLeft, relativeToImageTop, $(image),val);
      hotSpot.init();
      hotSpots.push(hotSpot);
    });
  }
})();