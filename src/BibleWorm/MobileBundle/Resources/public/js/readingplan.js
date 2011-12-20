$(function(){
    
    window.Reading = Backbone.Model.extend({
    });
    
    window.ReadingList = Backbone.Collection.extend({
        model: Reading,
        
        url: function() {
            return 'app_dev.php/api/v1/reading-plan';
        }
    });
    
    window.Readings = new JotList;
    
    window.ReadingView = Backbone.View.extend({

        tagName: "div",
        //className: "jot",
        //template: _.template($('#jot_template').html()),
        events: {
            "click .ui-checkbox"  : "read"
        },
        
        initialize: function() {
            this.model.bind('change', this.render, this);
        },

        render: function() {
            this.$el = $(this.el);
            //this.$el.html(this.template(this.model.toJSON()));
            
            return this;
        },
        
        read: function() {
            // if all three checked, change style of list to read
            
            // load reading in new pane
        },

        
        save: function() {
        }
    });
    
    
    window.AppView = Backbone.View.extend({
      
        //tagName: "nav",
        //className: "mr_peepers",
        
        initialize: function() {
            
            //Sets.bind('add',   this.addJot, this);
            //Sets.bind('reset', this.addAllJots, this);
            //Sets.bind('all',   this.render, this);
            
            Sets.fetch();
        },
        
        render: function() {
          console.log(this.el);
          this.$el = $(this.el);
        }
    });
    
    window.App = new AppView;
});