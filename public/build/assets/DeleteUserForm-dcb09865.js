import{o as a,f as n,y as h,M as j,r as v,A as T,j as O,k as C,b as e,e as U,n as _,d,t as V,g as M,J as A,O as x,K as E,T as z,a as c,w as b,u as f,R as K,U as L}from"./app-c10c3e4b.js";import{_ as N}from"./_plugin-vue_export-helper-c27b6911.js";import{_ as P,a as I,b as J}from"./TextInput-42453323.js";const R={},q={class:"inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"};function G(s,r){return a(),n("button",q,[h(s.$slots,"default")])}const F=N(R,[["render",G]]),H=["id"],Q={class:"modal-content"},W={class:"modal-header"},X={class:"modal-title"},Y={class:"modal-body p-4"},Z={class:"modal-footer mb-1"},ee=["disabled"],se={key:0},te=e("i",{class:"fas fa-circle-notch fa-spin"},null,-1),oe={key:1},ae={key:0},ne={key:1},le=e("i",{class:"bi bi-save"},null,-1),re=["disabled"],de={key:0},ie=e("i",{class:"fas fa-circle-notch fa-spin"},null,-1),ce={key:1},ue=e("i",{class:"bi bi-save"},null,-1),me={__name:"Modal",props:{errors:{type:Object,default:()=>({})},dataForm:{type:Object,default:()=>({})},modalTitle:{type:String,default:""},icon:{type:String,default:""},mode:{type:String,default:""},actionForm:{type:String,default:""},size:{type:String,default:""},upload:{type:Boolean,default:!1},isOpen:{type:Boolean,default:!1},idModal:{type:String,default:""}},emits:["closeModal","reset"],setup(s,{emit:r}){const o=s,l=j(),g=i=>l[i]!==void 0,t=v(!1),m=v(!1),u=T({}),y=O(()=>o.dataForm),w=O(()=>o.isOpen);C(y,()=>{Object.assign(u,o.dataForm)}),C(w,()=>{o.isOpen?($("body").addClass("modal-open"),$("body").append('<div id="backdrop" class="modal-backdrop fade show"></div>')):($("body").removeClass("modal-open"),$("#backdrop").remove())});const B=()=>{t.value=!0,x.post(o.actionForm,Object.assign(u,{_method:"post"}),{forceFormData:!0,preserveScroll:!0,onSuccess:()=>{p(),k(),t.value=!1,m.value=!1},onError:i=>{t.value=!1}})},k=()=>{u.value={},E().props.errors={}},p=()=>{r("closeModal"),$("body").removeClass("modal-open"),$("#backdrop").remove()},D=async()=>{t.value=!0,o.upload==!0?x.post(o.actionForm,Object.assign(u,{_method:"put"}),{preserveScroll:!0,onSuccess:()=>{p(),k(),t.value=!1},onError:i=>{t.value=!1}}):x.put(o.actionForm,u,{preserveScroll:!0,onSuccess:()=>{p(),k(),t.value=!1},onError:i=>{t.value=!1}})};return(i,S)=>(a(),n("div",{class:_(["modal fade",{show:s.isOpen}]),id:s.idModal?s.idModal:"create","data-bs-backdrop":"static","data-bs-keyboard":"false",tabindex:"","aria-labelledby":"createLabel","aria-hidden":"true",style:A([s.isOpen?{display:"block"}:{display:"none"}])},[e("div",{class:_(["modal-dialog",s.size])},[e("div",Q,[e("form",{onSubmit:S[0]||(S[0]=U(ke=>s.mode=="create"?B():D(),["prevent"])),enctype:"multipart/form-data"},[e("div",W,[e("h5",X,[e("i",{class:_([s.icon])},null,2),d(" "+V(s.modalTitle),1)]),e("button",{type:"button",class:"btn-close","data-bs-dismiss":"modal",onClick:p})]),e("div",Y,[h(i.$slots,"default")]),e("div",Z,[s.mode=="create"?(a(),n("button",{key:0,disabled:t.value,type:"submit",class:"btn btn-primary"},[t.value?(a(),n("span",se,[te,d(" Mohon Tunggu..")])):(a(),n("span",oe,[g("buttonLabel")?(a(),n("div",ae,[h(i.$slots,"buttonLabel")])):(a(),n("div",ne,[le,d(" Simpan ")]))]))],8,ee)):M("",!0),s.mode=="edit"?(a(),n("button",{key:1,disabled:t.value,type:"submit",class:"btn btn-primary"},[t.value?(a(),n("span",de,[ie,d(" Mohon Tunggu..")])):(a(),n("span",ce,[ue,d(" Update")]))],8,re)):M("",!0),e("button",{type:"button",class:"btn btn-outline-secondary","data-bs-dismiss":"modal",onClick:p}," Batal ")])],32)])],2)],14,H))}},pe=["type"],fe={__name:"SecondaryButton",props:{type:{type:String,default:"button"}},setup(s){return(r,o)=>(a(),n("button",{type:s.type,class:"inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"},[h(r.$slots,"default")],8,pe))}},ye={class:"space-y-6"},be=e("header",null,[e("h2",{class:"text-lg font-medium text-gray-900"},"Delete Account"),e("p",{class:"mt-1 text-sm text-gray-600"}," Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. ")],-1),_e={class:"p-6"},he=e("h2",{class:"text-lg font-medium text-gray-900"}," Are you sure you want to delete your account? ",-1),ve=e("p",{class:"mt-1 text-sm text-gray-600"}," Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account. ",-1),ge={class:"mt-6"},we={class:"mt-6 flex justify-end"},Oe={__name:"DeleteUserForm",setup(s){const r=v(!1),o=v(null),l=z({password:""}),g=()=>{r.value=!0,L(()=>o.value.focus())},t=()=>{l.delete(route("profile.destroy"),{preserveScroll:!0,onSuccess:()=>m(),onError:()=>o.value.focus(),onFinish:()=>l.reset()})},m=()=>{r.value=!1,l.reset()};return(u,y)=>(a(),n("section",ye,[be,c(F,{onClick:g},{default:b(()=>[d("Delete Account")]),_:1}),c(me,{show:r.value,onClose:m},{default:b(()=>[e("div",_e,[he,ve,e("div",ge,[c(P,{for:"password",value:"Password",class:"sr-only"}),c(I,{id:"password",ref_key:"passwordInput",ref:o,modelValue:f(l).password,"onUpdate:modelValue":y[0]||(y[0]=w=>f(l).password=w),type:"password",class:"mt-1 block w-3/4",placeholder:"Password",onKeyup:K(t,["enter"])},null,8,["modelValue","onKeyup"]),c(J,{message:f(l).errors.password,class:"mt-2"},null,8,["message"])]),e("div",we,[c(fe,{onClick:m},{default:b(()=>[d(" Cancel ")]),_:1}),c(F,{class:_(["ml-3",{"opacity-25":f(l).processing}]),disabled:f(l).processing,onClick:t},{default:b(()=>[d(" Delete Account ")]),_:1},8,["class","disabled"])])])]),_:1},8,["show"])]))}};export{Oe as default};