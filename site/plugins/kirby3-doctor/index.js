(function () {var a={name:"Doctor",props:{label:String,job:String,progress:String,cooldown:Number,status:String,results:Array},methods:{theme:function(t){var s="info";return"warning"==(t=t.toLowerCase())||"failure"==t?s="negative":"success"==t&&(s="positive"),s},doctor:function(){this.getRequest(this.job)},getRequest:function(t){var s=this,e=this.label;this.label=this.progress.length>0?this.progress:this.label+"...",this.status="doing-job",this.$api.get(t).then(function(t){void 0!==t.label&&(s.label=t.label),void 0!==t.data&&(s.results=t.data),void 0!==t.status?s.status=200==t.status?"is-success":"has-error":s.status="has-response",setTimeout(function(){s.label=e,s.status=""},s.cooldown)})}}};if(typeof a==="function"){a=a.options}Object.assign(a,function(){var render=function(){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c("div",[_c("k-button",{staticClass:"doctor",class:_vm.status,attrs:{"job":this.job},on:{"click":function($event){return _vm.doctor()}}},[_vm._v(_vm._s(_vm.label))]),_vm._v(" "),_vm._l(_vm.results,function(value,key){return _vm.results!==undefined?_c("k-info-field",{key:key,attrs:{"text":value.message,"theme":_vm.theme(value.result)}}):_vm._e()})],2)};var staticRenderFns=[];return{render:render,staticRenderFns:staticRenderFns,_compiled:true,_scopeId:null,functional:undefined}}());panel.plugin("bnomei/doctor",{fields:{doctor:a}});})();