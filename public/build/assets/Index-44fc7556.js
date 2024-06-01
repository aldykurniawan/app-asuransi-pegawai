import{r as c,E as V,l as R,T as A,A as $,z as q,o as d,c as x,w as k,a as b,b as t,d as I,e as L,h as C,v as M,u as p,G as U,f as h,x as j,F as G,n as H,t as v,g as Y,K,O as N}from"./app-0adca9c4.js";import{_ as J}from"./AuthenticatedLayout-895a8292.js";import{M as Q}from"./ModalPreview-56652255.js";import{M as W}from"./ModalForm-11501589.js";import{_ as X}from"./Pagination-2913a025.js";import"./_plugin-vue_export-helper-c27b6911.js";const Z={class:"col-12 col-lg-12 d-flex mx-auto"},tt={class:"card radius-10 w-100"},et={class:"card-header bg-transparent"},at={class:"row g-3 align-items-center"},ot={class:"col-12 col-lg-7"},st=t("i",{class:"bi bi-plus-circle"},null,-1),nt={class:"col-12 col-lg-5 text-md-end"},lt=["onSubmit"],it={class:"input-group mb-1"},rt=t("button",{type:"submit",class:"btn btn-outline-secondary",id:"pencarian"},[t("i",{class:"bx bx-search"})],-1),ct={class:"card-body"},dt={class:"table-responsive-sm"},ut={class:"table table-bordered"},mt=t("thead",{class:"table-active"},[t("tr",null,[t("th",{width:"1%",class:"text-center"},"No"),t("th",{width:"",class:""},"Nama"),t("th",{width:"10%",class:"text-center"},"#")])],-1),pt={class:"text-center"},_t={style:{"vertical-align":"middle"}},bt={style:{"vertical-align":"middle"},class:"text-center"},ht={class:"btn-group"},vt=["onClick"],gt=t("i",{class:"bi bi-pencil"},null,-1),ft=[gt],yt=["onClick"],wt=t("i",{class:"bi bi-trash"},null,-1),xt=[wt],kt={class:"row"},Ct={class:"col-md-12"},Mt={class:"form-group mb-3"},Nt=t("label",{class:"mb-2"},"Nama",-1),St={key:0,class:"invalid-feedback"},Et={__name:"Index",props:{dataSource:{type:Object,default:()=>({})},perPage:{type:Number,default:1},routeName:{type:String,default:""}},emits:["closeModal"],setup(u){const s=u,l=c(!1),g=V("$swal"),f=c(Math.random().toString(36).substring(2,15)),S=()=>Math.random().toString(36).substring(2,15);R(()=>{const a=new URLSearchParams(location.search);i.value=a.get("query")});let i=c("");const D=()=>{N.get(route(s.routeName+".index",{query:i.value}))},r=A({redirectRoute:s.routeName+".index",nama:null}),_=()=>{r.reset(),K().props.errors={}},B=()=>{m.value=!1,f.value=S()},m=c(!1),e=$({title:"Tambah Data",mode:"create",icon:"",size:"modal-md",actionForm:null}),F=()=>{_(),e.title="Buat Data",e.icon="bi bi-plus-circle",e.actionForm=route(s.routeName+".store"),e.mode="create",m.value=!0},T=async a=>{l.value=!0,await axios.get(route(s.routeName+".edit",a)).then(o=>{r.nama=o.data.nama,l.value=!1}).catch(o=>{console.log(o),l.value=!1})},P=async a=>{_(),e.title="Edit Data",e.icon="bi bi-pencil-square",e.actionForm=route(s.routeName+".update",a),e.mode="edit",await T(a),m.value=!0},z=c(null),E=async a=>{g({title:"Apakah Anda Yakin?",text:"Ingin Menghapus Data Ini ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Ya, Hapus!",cancelButtonText:"Batal"}).then(o=>{o.isConfirmed&&(l.value=!0,N.delete(route(s.routeName+".destroy",a),{onSuccess:y=>{l.value=!1,g("Deleted!","Data Telah Dihapus","success")},preserveScroll:!0}))})};return(a,o)=>{const y=q("loading-overlay");return d(),x(J,null,{default:k(()=>[b(y,{active:l.value,"is-full-page":!0,loader:"bars",color:"#2E86C1"},null,8,["active"]),t("div",Z,[t("div",tt,[t("div",et,[t("div",at,[t("div",ot,[t("button",{onClick:o[0]||(o[0]=()=>F()),type:"button",class:"btn btn-sm btn-primary"},[st,I(" Tambah ")])]),t("div",nt,[t("form",{onSubmit:L(D,["prevent"])},[t("div",it,[C(t("input",{type:"text",class:"form-control",placeholder:"Pencarian...","aria-label":"Pencarian","aria-describedby":"pencarian","onUpdate:modelValue":o[1]||(o[1]=n=>U(i)?i.value=n:i=n)},null,512),[[M,p(i)]]),rt])],40,lt)])])]),t("div",ct,[t("div",dt,[t("table",ut,[mt,t("tbody",null,[(d(!0),h(G,null,j(u.dataSource.data,(n,w)=>(d(),h("tr",{key:w},[t("td",pt,v(u.dataSource.current_page*s.perPage-s.perPage+w+1),1),t("td",_t,[t("b",null,v(n.nama),1)]),t("td",bt,[t("div",ht,[t("button",{onClick:O=>P(n.id),class:"btn btn-sm btn-warning","data-bs-toggle":"tooltip","data-placement":"top",title:"Edit Data"},ft,8,vt),t("button",{onClick:O=>E(n.id),class:"btn btn-sm btn-danger","data-bs-toggle":"tooltip","data-placement":"top",title:"Hapus Data"},xt,8,yt)])])]))),128))])])]),b(X,{links:u.dataSource.links},null,8,["links"])])])]),b(Q,{urlFile:z.value},null,8,["urlFile"]),(d(),x(W,{"modal-title":e.title,icon:e.icon,size:e.size,"data-form":p(r).data(),mode:e.mode,"action-form":e.actionForm,onReset:_,isOpen:m.value,onCloseModal:B,upload:!0,key:f.value},{default:k(()=>[t("div",kt,[t("div",Ct,[t("div",Mt,[Nt,C(t("input",{"onUpdate:modelValue":o[2]||(o[2]=n=>p(r).nama=n),type:"text",class:H(["form-control",{"is-invalid":a.errors.nama}]),placeholder:"....."},null,2),[[M,p(r).nama]]),a.errors.nama?(d(),h("div",St,v(a.errors.nama),1)):Y("",!0)])])])]),_:1},8,["modal-title","icon","size","data-form","mode","action-form","isOpen"]))]),_:1})}}};export{Et as default};