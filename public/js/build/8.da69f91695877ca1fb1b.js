webpackJsonp([8],{MG2X:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var a=s("mtWM"),r=s.n(a),i=s("md97"),o=s.n(i);e.default={name:"EventsCreateView",components:{SingleView:o.a},data:function(){return{form:{title:"",body:"",name:"",phone:"",email:"",organizer:"",url:"",date:""},errors:{},success:!1}},watch:{form:function(t){this.errors={}}},methods:{submit:function(){var t=this;r.a.post("/api/events",this.form).then(function(e){var s=e.data;t.errors={},t.success=s.message}).catch(function(e){var s=e.response;t.errors=s.data.errors})}}}},O4tm:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("single-view",{attrs:{cover:"/images/events-form-head.jpg",title:"item.name"}},[s("template",{slot:"title"},[s("div",{staticClass:"flex-1"},[s("h1",{staticClass:"font-normal mb-1"},[t._v("Zgłoś wydarzenie")]),t._v(" "),s("p",{staticClass:"text-grey-dark"},[t._v("Planujesz wydarzenie związane z rewitalizacją?")])]),t._v(" "),s("div")]),t._v(" "),s("template",{slot:"content"},[t.success?s("div",{staticClass:"md:w-1/2 text-teal"},[s("h3",{staticClass:"text-teal"},[t._v("Dziękujemy")]),t._v(" "),s("p",{staticClass:"text-xl",domProps:{textContent:t._s(t.success)}})]):s("form",{staticClass:"flex-1 flex",attrs:{method:"post"},on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[s("div",{staticClass:"md:w-2/3 md:pr-16 content"},[s("p",{},[t._v("Wypełnij poniższy formularz, żeby umieścić wydarzenie na naszej mapie.")]),t._v(" "),s("p",{staticClass:"mb-8"},[t._v("Uzupełnij wszystkie poniższe pola.")]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-title"}},[t._v("Nazwa wydarzenia")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.title,expression:"form.title"}],staticClass:"input",attrs:{type:"text",id:"event-title"},domProps:{value:t.form.title},on:{input:function(e){e.target.composing||t.$set(t.form,"title",e.target.value)}}}),t._v(" "),t.errors.title?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.title[0])}}):t._e()]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-organizer"}},[t._v("Organizator")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.organizer,expression:"form.organizer"}],staticClass:"input",attrs:{type:"text",id:"event-organizer"},domProps:{value:t.form.organizer},on:{input:function(e){e.target.composing||t.$set(t.form,"organizer",e.target.value)}}}),t._v(" "),t.errors.organizer?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.organizer[0])}}):t._e()]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-localization"}},[t._v("Miejsce")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.localization,expression:"form.localization"}],staticClass:"input",attrs:{type:"text",id:"event-localization"},domProps:{value:t.form.localization},on:{input:function(e){e.target.composing||t.$set(t.form,"localization",e.target.value)}}}),t._v(" "),t.errors.localization?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.localization[0])}}):t._e()]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-url"}},[t._v("Strona www")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.url,expression:"form.url"}],staticClass:"input",attrs:{type:"text",id:"event-url"},domProps:{value:t.form.url},on:{input:function(e){e.target.composing||t.$set(t.form,"url",e.target.value)}}}),t._v(" "),t.errors.url?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.url[0])}}):t._e()]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-info"}},[t._v("Opis wydarzenia")]),t._v(" "),s("textarea",{directives:[{name:"model",rawName:"v-model",value:t.form.body,expression:"form.body"}],staticClass:"textarea h-24",attrs:{id:"event-info"},domProps:{value:t.form.body},on:{input:function(e){e.target.composing||t.$set(t.form,"body",e.target.value)}}}),t._v(" "),t.errors.body?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.body[0])}}):t._e()])]),t._v(" "),s("div",{staticClass:"md:w-1/3 content"},[s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-date"}},[t._v("Data wydarzenia")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.date,expression:"form.date"}],staticClass:"input text-2xl",attrs:{type:"date",id:"event-date"},domProps:{value:t.form.date},on:{input:function(e){e.target.composing||t.$set(t.form,"date",e.target.value)}}}),t._v(" "),t.errors.date?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.date[0])}}):t._e()]),t._v(" "),s("h3",{staticClass:"pt-8"},[t._v("Dane kontaktowe")]),t._v(" "),s("p",[t._v("Wypełnij wszystkie poniższe pola. W razie pytań skontaktujemy się z Tobą celem doprecyzowania\n                    informacji.")]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-name"}},[t._v("Imię i nazwisko")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.name,expression:"form.name"}],staticClass:"input",attrs:{type:"text",id:"event-name"},domProps:{value:t.form.name},on:{input:function(e){e.target.composing||t.$set(t.form,"name",e.target.value)}}}),t._v(" "),t.errors.name?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.name[0])}}):t._e()]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-phone"}},[t._v("Numer telefonu")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.phone,expression:"form.phone"}],staticClass:"input",attrs:{type:"text",id:"event-phone"},domProps:{value:t.form.phone},on:{input:function(e){e.target.composing||t.$set(t.form,"phone",e.target.value)}}}),t._v(" "),t.errors.phone?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.phone[0])}}):t._e()]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-email"}},[t._v("Adres email")]),t._v(" "),s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"input",attrs:{type:"text",id:"event-email"},domProps:{value:t.form.email},on:{input:function(e){e.target.composing||t.$set(t.form,"email",e.target.value)}}}),t._v(" "),t.errors.email?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.email[0])}}):t._e()]),t._v(" "),s("div",{staticClass:"field"},[s("label",{staticClass:"label",attrs:{for:"event-file"}},[t._v("Zdjęcie")]),t._v(" "),s("input",{staticClass:"text-sm",attrs:{type:"file",id:"event-file"}}),t._v(" "),t.errors.file?s("span",{staticClass:"text-sm text-red font-medium",domProps:{textContent:t._s(t.errors.file[0])}}):t._e(),t._v(" "),s("p",[s("small",[t._v("Zdjęcie powinno być w możlwie największej rozdzielczości")])])]),t._v(" "),s("button",{staticClass:"font-semibold bg-teal text-white px-8 py-2 text-lg mb-8",attrs:{type:"submit"},on:{click:t.submit}},[t._v("\n                    Zgłoś wydarzenie\n                ")])])])])],2)},staticRenderFns:[]}},OXWv:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("article",{staticClass:"pt-18"},[t.header?s("header",{staticClass:"py-8"},[s("div",{staticClass:"container  flex justify-center"},[t._t("title",[t.title?s("div",{staticClass:"md:w-2/3"},[s("h1",{staticClass:"font-normal",domProps:{textContent:t._s(t.title)}})]):t._e()],{item:t.item})],2)]):t._e(),t._v(" "),t._t("cover",[t.cover?s("figure",{staticClass:"text-center"},[s("img",{attrs:{src:t.cover,alt:"title"}})]):t._e()]),t._v(" "),s("div",{staticClass:"py-8"},[s("div",{staticClass:"container flex justify-center"},[t._t("content:before"),t._v(" "),t._t("content",[s("div",{staticClass:"md:w-2/3 content"},[t._t("lead:before"),t._v(" "),t.lead?s("p",{staticClass:"text-2xl",domProps:{innerHTML:t._s(t.lead)}}):t._e(),t._v(" "),t._t("default"),t._v(" "),t.attachments.length?s("div",{staticClass:"mt-8 pt-8"},[s("h3",[t._v(" Załączniki")]),t._v(" "),s("ul",t._l(t.attachments,function(e){return s("li",[s("a",{attrs:{href:e.src}},[t._v("\n                                    "+t._s(e.caption)+"\n\n                                    "),s("small",{staticClass:"text-grey"},[t._v("[ pobierz ]")])])])}))]):t._e()],2)]),t._v(" "),t._t("content:after")],2)])],2)},staticRenderFns:[]}},Vien:function(t,e,s){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"SingleView",props:{title:{},lead:{},cover:{},attachments:{default:function(){return[]}},header:{default:!0},item:{}}}},lKNB:function(t,e,s){var a=s("VU/8")(s("MG2X"),s("O4tm"),!1,null,null,null);t.exports=a.exports},md97:function(t,e,s){var a=s("VU/8")(s("Vien"),s("OXWv"),!1,null,null,null);t.exports=a.exports}});