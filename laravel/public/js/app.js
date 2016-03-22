"use strict";

var br = (function () {

    var createFamily = function() {
        $.ajax({
                url: ("/create-family"),
                type: "post",
                data: {
                    name: $('.js__family--name').val()
                },
                dataType: 'json',
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                error: function(e) {
                    console.log('Error create');
                },
                success: function(data){
                        console.log(data);
                        $('.js__family--select').append('<option value="'+data.family.id+'">'+data.family.name+'</option>');
                }
        });
    };
    var createUnit = function() {
        $.ajax({
                url: ("/create-unit"),
                type: "post",
                data: {
                    name: $('.js__unit--name').val(),
                    parent_1: $('.js__parent_1').val(),
                    parent_2: $('.js__parent_2').val()
                },
                dataType: 'json',
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                error: function(e) {
                    console.log('Error create');
                },
                success: function(data){
                        console.log(data);
                        $('.js__parent_1').append('<option value="'+data.unit.id+'">'+data.unit.name+'</option>');
                        $('.js__parent_2').append('<option value="'+data.unit.id+'">'+data.unit.name+'</option>');
                        $('.js__get-tree').append('<option value="'+data.unit.id+'">'+data.unit.name+'</option>');
                }
        });
    };
    var getData = function() {
        $.ajax({
                url: ("/get-tree/"+$('.js__get-tree').val()),
                type: "get",
                dataType: 'json',
                beforeSend: function(request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                error: function(e) {
                    console.log('Error create');
                },
                success: function(data){
                        br.tree(data);
                }
        });
    };

    var tree = function(names) {
        var w = 960, h = 500;

        var labelDistance = 0;

        var vis = d3.select(".js__tree").append("svg:svg").attr("width", w).attr("height", h);

        var nodes = [];
        var labelAnchors = [];
        var labelAnchorLinks = [];
        var links = [];

        for(var i = 0; i < names.length; i++) {
            var node = {
                label : names[i].name
            };
            nodes.push(node);
            labelAnchors.push({
                node : node
            });
            labelAnchors.push({
                node : node
            });
        };
        for (var i = 0; i < names.length; i++) {
            if (!isNaN(names[i].parent_1)) {
                links.push({
                    source: names[i].id,
                    target: names[i].parent_1,
                    weight: 1
                });
            };
            if (!isNaN(names[i].parent_2)) {
                links.push({
                    source: names[i].id,
                    target: names[i].parent_2,
                    weight: 1
                });
            }
        };
        for(var i = 0; i < nodes.length; i++) {
            
            labelAnchorLinks.push({
                source : i * 2,
                target : i * 2 + 1,
                weight : 1
            });
        };

        var force = d3.layout.force().size([w, h]).nodes(nodes).links(links).gravity(1).linkDistance(50).charge(-3000).linkStrength(function(x) {
            return x.weight * 10
        });


        force.start();

        var force2 = d3.layout.force().nodes(labelAnchors).links(labelAnchorLinks).gravity(0).linkDistance(0).linkStrength(8).charge(-100).size([w, h]);
        force2.start();

        var link = vis.selectAll("line.link").data(links).enter().append("svg:line").attr("class", "link").style("stroke", "#CCC");

        var node = vis.selectAll("g.node").data(force.nodes()).enter().append("svg:g").attr("class", "node");
        node.append("svg:circle").attr("r", 5).style("fill", "#555").style("stroke", "#FFF").style("stroke-width", 5);
        node.call(force.drag);


        var anchorLink = vis.selectAll("line.anchorLink").data(labelAnchorLinks)//.enter().append("svg:line").attr("class", "anchorLink").style("stroke", "#999");

        var anchorNode = vis.selectAll("g.anchorNode").data(force2.nodes()).enter().append("svg:g").attr("class", "anchorNode");
        anchorNode.append("svg:circle").attr("r", 0).style("fill", "#FFF");
            anchorNode.append("svg:text").text(function(d, i) {
            return i % 2 == 0 ? "" : d.node.label
        }).style("fill", "#555").style("font-family", "Arial").style("font-size", 12);

        var updateLink = function() {
            this.attr("x1", function(d) {
                return d.source.x;
            }).attr("y1", function(d) {
                return d.source.y;
            }).attr("x2", function(d) {
                return d.target.x;
            }).attr("y2", function(d) {
                return d.target.y;
            });

        }

        var updateNode = function() {
            this.attr("transform", function(d) {
                return "translate(" + d.x + "," + d.y + ")";
            });

        }

        force.on("tick", function() {

            force2.start();

            node.call(updateNode);

            anchorNode.each(function(d, i) {
                if(i % 2 == 0) {
                    d.x = d.node.x;
                    d.y = d.node.y;
                } else {
                    var b = this.childNodes[1].getBBox();

                    var diffX = d.x - d.node.x;
                    var diffY = d.y - d.node.y;

                    var dist = Math.sqrt(diffX * diffX + diffY * diffY);

                    var shiftX = b.width * (diffX - dist) / (dist * 2);
                    shiftX = Math.max(-b.width, Math.min(0, shiftX));
                    var shiftY = 5;
                    this.childNodes[1].setAttribute("transform", "translate(" + shiftX + "," + shiftY + ")");
                }
            });

            anchorNode.call(updateNode);

            link.call(updateLink);
            anchorLink.call(updateLink);
        });
    };
    return {
        createFamily: createFamily,
        createUnit: createUnit,
        getData: getData,
        tree: tree
    };
}());

$(document).ready(function(){
    $('.js__family--create').on('click', function() {
        br.createFamily();
    });
    $('.js__unit--create').on('click', function() {
        br.createUnit();
    });
    $('.js__unit--show').on('click', function(event) {
        br.getData();
    });
    $('.js__patriarch').on('change', function(event) {
        if ($('.js__patriarch').is(':checked')) {
            $('select[name=parent_1]').attr('disabled', 'disabled');
            $('select[name=parent_2]').attr('disabled', 'disabled');
        }else{
            $('select[name=parent_1]').removeAttr('disabled');
            $('select[name=parent_2]').removeAttr('disabled');
        };
    });
});
