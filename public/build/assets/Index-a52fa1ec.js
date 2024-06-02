import{r as m,E as ne,j as re,k as $,l as de,B as ce,O as G,T as ue,A as me,z as L,o as d,c as R,w as q,a as M,b as e,d as n,e as _e,h as v,v as f,f as c,x as pe,F,u,n as g,t as l,g as p,K as be,p as he,i as ve,L as z,C as H}from"./app-c10c3e4b.js";import{_ as fe}from"./AuthenticatedLayout-26e8450e.js";import{M as ge}from"./ModalPreview-a72084c6.js";import{M as ke}from"./ModalForm-3dff2dca.js";import{_ as ye}from"./Pagination-07c5cac2.js";import{t as we}from"./AlertPlugins-ca12aa47.js";import{_ as Ce}from"./_plugin-vue_export-helper-c27b6911.js";const i=b=>(he("data-v-e4324447"),b=b(),ve(),b),xe={class:"col-12 col-lg-12 d-flex mx-auto"},Se={class:"card radius-10 w-100"},Be={class:"card-header bg-transparent"},Me={class:"row g-3 align-items-center"},je={class:"col-12 col-lg-7"},De=i(()=>e("i",{class:"bi bi-plus-circle"},null,-1)),Ee={class:"col-12 col-lg-5 text-md-end"},Ie=["onSubmit"],Ne={class:"input-group mb-1"},Ve=i(()=>e("button",{type:"submit",class:"btn btn-outline-secondary",id:"pencarian"},[e("i",{class:"bx bx-search"})],-1)),Te={class:"card-body"},Le={class:"table-responsive-sm"},Fe={class:"card radius-10 shadow-none border mb-3 best-product-item"},ze=["onClick"],Pe=i(()=>e("i",{class:"bi bi-ui-radios"},null,-1)),Ue={class:"card-body",style:{padding:"0.5rem 1rem 0rem 1rem"}},Ke={class:"custom-label badge badge-flat bg-secondary cap"},Ae={class:"frame__content"},Oe={class:"frame__image"},$e=["src"],Ge={class:"frame__info next_info"},Re={class:"info--data info--title"},qe=["onClick"],He=i(()=>e("i",{class:"bi bi-card-text"},null,-1)),Je=["onClick"],Ye=i(()=>e("i",{class:"bi bi-pencil"},null,-1)),Ze=["onClick"],Qe=i(()=>e("i",{class:"bi bi-upc"},null,-1)),We={class:"info--data"},Xe=i(()=>e("i",{class:"bi bi-tags"},null,-1)),ea={class:"frame__info next_payment"},aa={class:"info--data"},sa=i(()=>e("i",{class:"bi bi-cash"},null,-1)),ta={class:"info--data"},oa=i(()=>e("i",{class:"bi bi-piggy-bank-fill"},null,-1)),ia={class:"info--data"},la=i(()=>e("i",{class:"bi bi-cash-coin"},null,-1)),na={class:"frame__info next_stok"},ra={class:"info--data info--title"},da={class:"framer--title"},ca=i(()=>e("i",{class:"bi bi-box-arrow-in-left"},null,-1)),ua=["href"],ma=i(()=>e("i",{class:"bi bi-door-open-fill"},null,-1)),_a=[ma],pa={class:"info--data info--title"},ba={class:"framer--title"},ha=i(()=>e("i",{class:"bi bi-box-arrow-in-right"},null,-1)),va={class:"info--data"},fa=i(()=>e("i",{class:"bi bi-bricks"},null,-1)),ga={class:"frame__info next_deskripsi"},ka=["onClick"],ya=i(()=>e("i",{class:"bi bi-info-circle-fill"},null,-1)),wa=["onClick"],Ca={key:0,class:"row"},xa={class:"col-md-12"},Sa={class:"form-group mb-3"},Ba=i(()=>e("label",{class:"mb-2"},"Barcode",-1)),Ma={class:"btn-group w-100"},ja=["disabled","readonly"],Da={key:0,class:"text-red text-12 mt-1"},Ea={class:"col-md-6"},Ia={class:"form-group mb-3"},Na=i(()=>e("label",{class:"mb-2"},[n("Nama "),e("span",{class:"text-red"},"*")],-1)),Va={key:0,class:"invalid-feedback"},Ta={class:"col-md-6"},La={class:"form-group mb-3"},Fa=i(()=>e("label",{class:"mb-2"},[n("Merk "),e("span",{class:"text-red"},"*")],-1)),za={key:0,class:"invalid-feedback"},Pa={class:"col-md-6"},Ua={class:"form-group mb-3"},Ka=i(()=>e("label",{class:"mb-2 cap"},[n("Harga jual "),e("span",{class:"text-red"},"*")],-1)),Aa={key:0,class:"invalid-feedback"},Oa={class:"col-md-6"},$a={class:"form-group mb-3"},Ga=i(()=>e("label",{class:"mb-2"},[n(" Diskon "),e("span",{class:"text-muted text-12 cap"},"(dalam persen)"),e("span",{class:"text-red"},"*")],-1)),Ra={key:0,class:"invalid-feedback"},qa={class:"col-md-12"},Ha={class:"form-group mb-3"},Ja=i(()=>e("label",{class:"mb-2"},[n("Kategori "),e("span",{class:"text-red"},"*")],-1)),Ya={key:0,class:"invalid-feedback"},Za={class:"col-md-12"},Qa={class:"form-group mb-3"},Wa=i(()=>e("label",{class:"mb-2"},[n("Deskripsi "),e("span",{class:"text-red"},"*")],-1)),Xa={key:0,class:"invalid-feedback"},es={class:"col-md-12"},as={class:"form-group mb-3"},ss={class:"mb-2"},ts={key:0,class:"text-red"},os={key:0,class:"text-red"},is={__name:"Index",props:{dataSource:{type:Object,default:()=>({})},perPage:{type:Number,default:1},routeName:{type:String,default:""},dataKategori:{type:Array,default:[]}},emits:["closeModal"],setup(b){const h=b,j=a=>{z.fire({title:"<h5>Detail</h5>",html:`<p style="text-align: left; font-size: 12px;">${a}</p>`,showCloseButton:!0,showConfirmButton:!1,showCancelButton:!1})},k=m(!1),P=ne("$swal"),U=m(Math.random().toString(36).substring(2,15)),J=()=>Math.random().toString(36).substring(2,15),Y=(a,s)=>{o[a]=s},_=m(null),y=m(!1),D=m(null),E=m(null),K=re({get(){return y.value?D.value:_.value},set(a){y.value?D.value=a:_.value=a}}),Z=a=>{_.value=null,D.value=null,y.value=a,a?window.removeEventListener("keydown",w):window.addEventListener("keydown",w)},A=(a,s)=>{let S;return function(...T){const t=()=>{clearTimeout(S),a(...T)};clearTimeout(S),S=setTimeout(t,s)}};$(D,A(a=>{_.value=a},500)),$(()=>_.value,a=>{a?(z.fire({title:"Loading...",text:"Sedang Memeriksa Barcode",showConfirmButton:!1,allowOutsideClick:!1,allowEscapeKey:!1,allowEnterKey:!1}),Q()):o.barcode=null});const Q=A(async()=>{z.close();try{const a=await H.get(route(h.routeName+".checkBarcode",{barcode:_.value}));a.data.status&&r.mode=="create"?(we("info","Barcode Ditemukan: "+a.data.data.nama),x.value=!1,C.value=a.data.data.barcode,N()):(o.barcode=_.value,window.removeEventListener("keydown",w))}catch(a){console.log(a,"error")}},500),I=m(!1),B=m("");de(()=>{const a=new URLSearchParams(location.search);C.value=a.get("query")}),ce(()=>{window.removeEventListener("keydown",w)});const w=a=>{a.key.length===1&&/[a-zA-Z0-9]/.test(a.key)&&(I.value?B.value+=a.key:(I.value=!0,B.value=a.key)),a.key==="Enter"&&B.value&&(W(B.value),B.value="",I.value=!1)},W=a=>{x.value?_.value=a:(C.value=a,N())},C=m(""),N=()=>{G.get(route(h.routeName+".index",{query:C.value}))},o=ue({redirectRoute:h.routeName+".index",barcode:null,nama:null,merk:null,deskripsi:null,hargajual:null,diskon:null,gambar:null,kategori_id:null}),V=()=>{o.reset(),_.value=null,E.value=null,be().props.errors={}},X=()=>{x.value=!1,U.value=J()},x=m(!1),r=me({title:"Tambah Data",mode:"create",icon:"",size:"modal-lg",actionForm:null}),ee=()=>{V(),r.title="Buat / Scan Barang",r.icon="bi bi-plus-circle",r.actionForm=route(h.routeName+".store"),r.mode="create",r.size="modal-lg",x.value=!0,window.addEventListener("keydown",w)},ae=async a=>{k.value=!0,await H.get(route(h.routeName+".edit",a)).then(s=>{_.value=s.data.barcode,o.nama=s.data.nama,o.merk=s.data.merk,o.deskripsi=s.data.deskripsi,o.hargajual=s.data.hargajual,o.diskon=s.data.diskon,E.value=s.data.full_path,o.kategori_id=s.data.kategori_id,k.value=!1}).catch(s=>{console.log(s),k.value=!1})},se=async(a,s=!1)=>{V(),r.title=s?"Laporan Penjualan":"Edit Data",r.icon=s?"bi bi-bag-plus-fill":"bi bi-pencil-square",r.actionForm=s?null:route(h.routeName+".update",a),r.mode=s?"stok":"edit",r.size=s?"modal-fullscreen":"modal-lg",window.removeEventListener("keydown",w),await ae(a),localStorage.removeItem("cart"),localStorage.removeItem("totalBayar"),x.value=!0},te=m(null),oe=async a=>{P({title:"Apakah Anda Yakin?",text:"Ingin Menghapus Data Ini ?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"Ya, Hapus!",cancelButtonText:"Batal"}).then(s=>{s.isConfirmed&&(k.value=!0,G.delete(route(h.routeName+".destroy",a),{onSuccess:S=>{k.value=!1,P("Deleted!","Data Telah Dihapus","success")},preserveScroll:!0}))})};return(a,s)=>{const S=L("loading-overlay"),O=L("v-select"),T=L("file-component");return d(),R(fe,null,{default:q(()=>[M(S,{active:k.value,"is-full-page":!0,loader:"bars",color:"#2E86C1"},null,8,["active"]),e("div",xe,[e("div",Se,[e("div",Be,[e("div",Me,[e("div",je,[e("button",{onClick:s[0]||(s[0]=()=>ee()),type:"button",class:"btn btn-sm btn-primary"},[De,n(" Tambah / Scan Barang ")])]),e("div",Ee,[e("form",{onSubmit:_e(N,["prevent"])},[e("div",Ne,[v(e("input",{type:"text",class:"form-control",placeholder:"Pencarian...","aria-label":"Pencarian","aria-describedby":"pencarian","onUpdate:modelValue":s[1]||(s[1]=t=>C.value=t)},null,512),[[f,C.value]]),Ve])],40,Ie)])])]),e("div",Te,[e("div",Le,[(d(!0),c(F,null,pe(b.dataSource.data,(t,ie)=>(d(),c("div",{key:ie,class:"col-12 col-lg-12"},[e("div",Fe,[e("span",{class:"badge badge-flat badge-info bg-danger",onClick:le=>oe(t.id)},[Pe,n(" Hapus ")],8,ze),e("div",Ue,[e("span",Ke," Kategori: "+l(t.kategori.nama),1),e("div",Ae,[e("div",Oe,[e("img",{src:t.full_path,alt:"..."},null,8,$e)]),e("div",Ge,[e("div",Re,[e("div",{class:"framer--title",onClick:()=>j(t.nama)},[He,n(" "+l(t.short_title),1)],8,qe),e("div",{class:"edit-data",onClick:le=>se(t.id)},[Ye,n(" Edit ")],8,Je)]),e("div",{class:"info--data",onClick:()=>j(t.barcode)},[Qe,n(" "+l(t.barcode_short),1)],8,Ze),e("div",We,[Xe,n(" "+l(t.merk),1)])]),e("div",ea,[e("div",aa,[sa,n(" Jual: "+l(t.rupiah_hargajual),1)]),e("div",ta,[oa,n(" Diskon: "+l(t.total_diskon.diskon_rupiah)+" ("+l(t.diskon)+"%) ",1)]),e("div",ia,[la,n(" Setelah Diskon: "+l(t.total_diskon.harga_setelah_diskon_rp),1)])]),e("div",na,[e("div",ra,[e("div",da,[ca,n(" Stok Masuk: "+l(t.barang_stok_masuk),1)]),e("a",{href:a.route(h.routeName+".show",t.id),class:"edit-data bg-danger-data"},_a,8,ua)]),e("div",pa,[e("div",ba,[ha,n(" Terjual: "+l(t.barang_stok_terjual),1)])]),e("div",va,[fa,n(" Total Stok: "+l(t.barang_stok_sisa),1)])]),e("div",ga,[e("div",{class:"info--data",onClick:()=>j(t.deskripsi)},[ya,n(" Deskripsi: ")],8,ka),e("div",{class:"info--data text-muted text-12",onClick:()=>j(t.deskripsi)},l(t.short_deskripsi),9,wa)])])])])]))),128))]),M(ye,{links:b.dataSource.links},null,8,["links"])])])]),M(ge,{urlFile:te.value},null,8,["urlFile"]),(d(),R(ke,{"modal-title":r.title,icon:r.icon,size:r.size,"data-form":u(o).data(),mode:r.mode,"action-form":r.actionForm,onReset:V,isOpen:x.value,onCloseModal:X,upload:!0,key:U.value},{default:q(()=>[r.mode!=="stok"?(d(),c("div",Ca,[e("div",xa,[e("div",Sa,[Ba,e("div",Ma,[v(e("input",{"onUpdate:modelValue":s[2]||(s[2]=t=>K.value=t),type:"text",class:g(["form-control",{"is-invalid":a.errors.barcode}]),placeholder:".....",disabled:r.mode=="edit",readonly:!y.value},null,10,ja),[[f,K.value]]),e("button",{class:"btn btn-primary btn-input",type:"button",onClick:s[3]||(s[3]=()=>Z(!y.value))},l(y.value?"Scan":"Input")+" Barcode ",1)]),a.errors.barcode?(d(),c("div",Da,l(a.errors.barcode),1)):p("",!0)])]),u(o).barcode?(d(),c(F,{key:0},[e("div",Ea,[e("div",Ia,[Na,v(e("input",{"onUpdate:modelValue":s[4]||(s[4]=t=>u(o).nama=t),type:"text",class:g(["form-control",{"is-invalid":a.errors.nama}]),placeholder:"....."},null,2),[[f,u(o).nama]]),a.errors.nama?(d(),c("div",Va,l(a.errors.nama),1)):p("",!0)])]),e("div",Ta,[e("div",La,[Fa,v(e("input",{"onUpdate:modelValue":s[5]||(s[5]=t=>u(o).merk=t),type:"text",class:g(["form-control",{"is-invalid":a.errors.merk}]),placeholder:"....."},null,2),[[f,u(o).merk]]),a.errors.merk?(d(),c("div",za,l(a.errors.merk),1)):p("",!0)])]),e("div",Pa,[e("div",Ua,[Ka,v(e("input",{"onUpdate:modelValue":s[6]||(s[6]=t=>u(o).hargajual=t),type:"number",class:g(["form-control",{"is-invalid":a.errors.hargajual}]),placeholder:"....."},null,2),[[f,u(o).hargajual]]),a.errors.hargajual?(d(),c("div",Aa,l(a.errors.hargajual),1)):p("",!0)])]),e("div",Oa,[e("div",$a,[Ga,v(e("input",{"onUpdate:modelValue":s[7]||(s[7]=t=>u(o).diskon=t),type:"number",class:g(["form-control",{"is-invalid":a.errors.diskon}]),placeholder:"....."},null,2),[[f,u(o).diskon]]),a.errors.diskon?(d(),c("div",Ra,l(a.errors.diskon),1)):p("",!0)])]),e("div",qa,[e("div",Ha,[Ja,M(O,{options:b.dataKategori,label:"nama",placeholder:"Pilih Kategori",modelValue:u(o).kategori_id,"onUpdate:modelValue":s[8]||(s[8]=t=>u(o).kategori_id=t),reduce:t=>t.id,class:g({"is-invalid":a.errors.kategori_id})},null,8,["options","modelValue","reduce","class"]),a.errors.kategori_id?(d(),c("div",Ya,l(a.errors.kategori_id),1)):p("",!0)])]),e("div",Za,[e("div",Qa,[Wa,a.errors.deskripsi?(d(),c("div",Xa,l(a.errors.deskripsi),1)):p("",!0),v(e("textarea",{"onUpdate:modelValue":s[9]||(s[9]=t=>u(o).deskripsi=t),class:g(["form-control",{"is-invalid":a.errors.deskripsi}]),placeholder:".....",rows:"5"},null,2),[[f,u(o).deskripsi]])])]),e("div",es,[e("div",as,[e("label",ss,[n("Gambar "),r.mode=="create"?(d(),c("span",ts,"*")):p("",!0)]),M(T,{triggerChange:t=>Y("gambar",t),previewImage:E.value,mime:["image/jpeg","image/jpg","image/png","image/PNG","image/JPG"]},null,8,["triggerChange","previewImage"]),a.errors.gambar?(d(),c("div",os,l(a.errors.gambar),1)):p("",!0)])])],64)):p("",!0)])):(d(),c(F,{key:1},[n(" tampil bang ")],64))]),_:1},8,["modal-title","icon","size","data-form","mode","action-form","isOpen"]))]),_:1})}}},ps=Ce(is,[["__scopeId","data-v-e4324447"]]);export{ps as default};