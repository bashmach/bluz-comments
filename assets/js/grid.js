var refreshGrid;

define(['jquery'], function($) {
  var $grid = $('#comments')
    , href = window.location.pathname;

  var changeStatus = function(url, ids, status) {

    $.ajax({
      url: url
      , type: 'post'
      , dataType: 'json'
      , data: {
        _json: 1,
        data: {
          id: ids,
          status: status
        }
      }
      , success: function(response) {
        if (1 === response.status) {
          refreshGrid();
        }
      }
    });
  }

  /**
   * Refresh grid content
   *
   * @return {boolean}
   */
  refreshGrid = function() {
    if (href === '#') {
      return false;
    }

    $.ajax({
      url: href,
      type: 'get',
      dataType: 'html',
      beforeSend: function () {
        $grid.find('a, .btn').addClass('disabled');
      },
      success: function (html) {
        /*
         need to replace only content of grid
         current         loaded
         <div>           <div>
         [...]   <--     [...]
         </div>          </div>
         */
        $grid.html($(html).children().unwrap());
      }
    });
    return false;
  }

  $grid.on('click', '#select-all', function () {
    $grid.find('.table input[name="select"]')
      .attr('checked', $(this).is(':checked'))
      .change();
  });

  $grid.on('change', '.table input[name="select"]', function () {
    var selects = $grid.find('.table input[name="select"]:checked')
      , toggle = (selects.length < 1);

    $grid.find('.navbar button').toggleClass('disabled', toggle);
  });

  $grid.on('click', '.navbar button:not(.disabled)', function() {
    var ids = [];
    $grid.find('.table input[name="select"]:checked').map(function() {
      ids.push($(this).attr('value'));
    })

    changeStatus($(this).data('href'), ids, $(this).data('status'));
  })
})