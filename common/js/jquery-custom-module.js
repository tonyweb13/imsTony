//=== Announcement or News Ticker ===//

//=== Slot Items ===//
var table_data3="";

for(var i = 0 ;i<20;i++){
    table_data3 += "<div class=\"slot-box\">";
    table_data3 += "<div class=\"slot-item\" style=\"background:url('/common/images/slot/Avalon2.png') 0 0 no-repeat #fbfbfb;\">";
    table_data3 += "<div class=\"slot-new0\"></div>";
    table_data3 += "<div class=\"slot-top02\"></div>";
    table_data3 += "<p>Avalon II</p>";
    table_data3 += "</div>";
    table_data3 += "</div>";
}

$(".slot-items").html(table_data3);


//=== List Items ===//
var table_data4="";

for(var i = 0 ;i<30;i++){
    if(i%2 == 0){
        table_data4 += "<div class=\"list-row-box\">";
    }else{
        table_data4 += "<div class=\"list-row-box highlight\">";
    }
    table_data4 += "<div class=\"row-col width18 text-center\">GD</div>";
    table_data4 += "<div class=\"row-col width25 text-center\">Baccarat</div>";
    table_data4 += "<div class=\"row-col width25 text-center\">3D Baccarat</div>";
    table_data4 += "<div class=\"row-col width16 text-center\">18</div>";
    table_data4 += "<div class=\"row-col width16 text-center\">2014-06-08</div>";
    table_data4 += "</div>";
}

$(".list-items").html(table_data4);