$(function () {
    $.extend({
        unixToDate:function (unixTime) {
            let times = unixTime*1000;
            let date = new Date(times);
            let ymd = "";
            ymd += date.getFullYear()+"-";
            ymd += (date.getMonth()+1) + "-";
            ymd += date.getDate();
            return ymd;
        },
        activityType:function (type) {
            switch (type) {
                case 0:
                    return "无活动";
                case 1:
                    return "秒杀";
                case 3:
                    return "限量折扣";
                case 12:
                    return "限时折扣";
                case 13:
                    return "大促活动";
                case 14:
                    return "大促活动";
                case 15:
                    return "品牌清仓";
                case 16:
                    return "食品超市";
                case 17:
                    return "一元幸运团";
                case 18:
                    return "爱逛街";
                case 19:
                    return "时尚穿搭";
                case 20:
                    return "男人帮";
                case 21:
                    return "9块9";
                case 22:
                    return "竞价活动";
                case 23:
                    return "榜单活动";
                case 24:
                    return "幸运半价购";
                case 25:
                    return "定金预售";
                case 26:
                    return "幸运人气购";
                case 27:
                    return "特色主题活动";
                case 28:
                    return "断码清仓";
                case 29:
                    return "一元话费";
                case 30:
                    return "电器城";
                case 31:
                    return "每日好店";
                case 32:
                    return "品牌卡";
                case 101:
                    return "大促搜索池";
                case 102:
                    return "大促品类分会场";
                default:
                    return "无活动";
            }
        }
    })
});