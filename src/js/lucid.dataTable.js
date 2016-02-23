lucid.dataTable={};

lucid.dataTable.sort=function(tableId,newCol){
    var table = jQuery('#' + tableId);
    var sortSelector = '#' + tableId + ' > thead > tr > th:nth-child(';
    var sortDir = table.attr('data-sort-dir');
    var sortCol = parseInt(table.attr('data-sort-col'));
    if(sortCol == newCol){
        var icon = jQuery(sortSelector + String(newCol + 1) + ') > i');
        icon.removeClass('fa-chevron-'  + ((sortDir == 'desc')?'down':'up'));
        icon.addClass(   'fa-chevron-'  + ((sortDir == 'desc')?'up':'down'));
        table.attr(      'data-sort-dir', ((sortDir == 'desc')?'asc':'desc'))
    }else{
        jQuery(sortSelector + String(sortCol + 1) + ') > i').removeClass('fa-chevron-'+((sortDir == 'desc')?'down':'up')).addClass('fa-chevron-right');
        jQuery(sortSelector + String(newCol + 1) +  ') > i').removeClass('fa-chevron-right').addClass('fa-chevron-up');
        table.attr('data-sort-col', newCol);
        table.attr('data-sort-dir', 'asc');
    }
    lucid.dataTable.requestData(tableId);
};

lucid.dataTable.requestData=function(tableId){
    var table = jQuery('#'+tableId);
    var url   = table.attr('data-url');
    var data  = {
        'sort_col':table.attr('data-sort-col'),
        'sort_dir':table.attr('data-sort-dir'),
        'page'    :table.attr('data-page'),
        'limit'   :table.attr('data-limit'),
        'refresh' :'please'
    };
    lucid.request(url, data);
}
