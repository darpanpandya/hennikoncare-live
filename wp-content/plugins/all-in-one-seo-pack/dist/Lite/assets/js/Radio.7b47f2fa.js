import{S as d}from"./Checkmark.e40641dd.js";import{v as m,o,c as p,m as r,a as s,G as i,k as f,b as g,H as c,E as _}from"./runtime-dom.esm-bundler.5c3c7d72.js";import{_ as y}from"./_plugin-vue_export-helper.eefbdd86.js";const b={components:{SvgCheckmark:d},props:{modelValue:[String,Boolean],name:String,labelClass:{type:String,default(){return""}},inputClass:{type:String,default(){return""}},id:String,size:String,disabled:Boolean,type:{type:Number,default(){return 1}}},computed:{typeClass(){return`type-${this.type}`}},methods:{labelToggle(){this.$refs.input.click()}}},k={class:"form-radio-wrapper"},h={class:"form-radio"},C=["checked","disabled","name","id"],S={class:"fancy-radio"};function B(l,t,e,v,T,a){const u=m("svg-checkmark");return o(),p("label",{class:i(["aioseo-radio",[e.labelClass,{[e.size]:e.size},a.typeClass,{disabled:e.disabled}]]),onKeydown:[t[1]||(t[1]=c((...n)=>a.labelToggle&&a.labelToggle(...n),["enter"])),t[2]||(t[2]=c((...n)=>a.labelToggle&&a.labelToggle(...n),["space"]))],onClick:_(()=>{},["stop"])},[r(l.$slots,"header"),s("span",k,[s("span",h,[s("input",{type:"radio",onInput:t[0]||(t[0]=n=>l.$emit("update:modelValue",n.target.checked)),checked:e.modelValue,disabled:e.disabled,name:e.name,id:e.id,class:i(e.inputClass),ref:"input"},null,42,C),s("span",S,[e.type===1?(o(),f(u,{key:0})):g("",!0)])])]),r(l.$slots,"default")],34)}const x=y(b,[["render",B]]);export{x as B};
