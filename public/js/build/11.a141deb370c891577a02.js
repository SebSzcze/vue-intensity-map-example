webpackJsonp([11],{"77Kr":function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("sidebar",[s("h1",{staticClass:"text-white text-xl font-bold mt-0 mb-2"},[t._v("Natężenia")]),t._v(" "),s("scrollbar",{staticClass:"flex-1 relative mb-8 -mr-2",staticStyle:{height:"400px"}},t._l(t.legends,function(e){return s("router-link",{key:e.id,staticClass:"mt-4",attrs:{to:{name:"IntesityView",params:{key:e.key}}}},[s("h2",{staticClass:"text-white font-semibold text-lg mb-1",domProps:{textContent:t._s(e.name)}}),t._v(" "),s("p",{staticClass:"text-grey-light text-xs",domProps:{textContent:t._s(e.description)}})])}))],1)},staticRenderFns:[]}},RWdX:function(t,e,s){var n=s("VU/8")(s("nI0O"),s("77Kr"),!1,null,null,null);t.exports=n.exports},nI0O:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"IntesityList",computed:{legends:function(){return this.$store.state.legends}}}}});