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

lucid.dataTable.changePage=function(tableId, page){
    var table   = jQuery('#' + tableId);
    var curPage = parseInt(table.attr('data-page'));
    var maxPage = parseInt(table.attr('data-page-count'));
    var newPage = null;
    switch(page){
        case 'first':
            newPage = 0;
            break;
        case 'previous':
            newPage = curPage - 1;
            break;
        case 'next':
            newPage = curPage + 1;
            break;
        case 'last':
            newPage = maxPage - 1;
            break;
        default:
            newPage = page;
            break;
    }
    if(newPage == curPage){
        return;
    }
    if(newPage < 0 || newPage >= maxPage){
        return;
    }
    table.attr('data-page',newPage);
    lucid.dataTable.requestData(tableId);
}

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
    lucid.request(url, data, function(){
        lucid.dataTable.rebuildPager(tableId);
    });
}

lucid.dataTable.rebuildPager=function(tableId){
    var table = jQuery('#'+tableId);
    var btn   = jQuery('#'+tableId+' > tfoot > tr > td > div > button.dropdown-toggle');
    var menu  = jQuery('#'+tableId+' > tfoot > tr > td > div > div.dropdown-menu');
    var currentPage  = parseInt(table.attr('data-page'));
    var newPageCount = parseInt(table.attr('data-page-count'));
    var oldPageCount = parseInt(menu.find(' > a').length);
    if(newPageCount != oldPageCount){
        var html = '';
        for(var i=0; i<newPageCount; i++){
            html += '<a href="javascript:lucid.dataTable.changePage(\''+table_id+'\','+i+')" class="dropdown-item">' + _('lucid:data_table:page_display', {'current':(i + 1), 'max':newPageCount})+ '</a>';
        }
        menu.html(html);
    }
    btn.html(_('lucid:data_table:page_display', {'current':(currentPage + 1), 'max':newPageCount}));
}
