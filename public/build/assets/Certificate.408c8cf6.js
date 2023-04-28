import{_ as I}from"./AdminLayout.908ec7b8.js";import{_ as O}from"./_plugin-vue_export-helper.cdc0426e.js";import{U as T}from"./UploadOutlined.d3366d82.js";import{R as A}from"./RestFilled.b4429dae.js";import{C as i,o as c,c as f,w as o,a as s,b as a,f as u,d as b,e as _}from"./app.505072c8.js";import"./UserOutlined.870741e4.js";import"./AppstoreOutlined.e053d997.js";const q={components:{AdminLayout:I,UploadOutlined:T,RestFilled:A},props:["certificates"],data(){return{modal:{isOpen:!1,data:{},title:"Modal",mode:""},columns:[{title:"\u5C08\u696D\u8A8D\u8B49",dataIndex:"name"},{title:"\u8A8D\u8B49\u540D\u7A31",dataIndex:"cert_title"},{title:"\u8A8D\u8B49\u6A5F\u69CB",dataIndex:"cert_body"},{title:"\u8A8D\u8B49\u6A23\u5F0F",dataIndex:"cert_template"},{title:"\u7DE8\u865F\u683C\u5F0F",dataIndex:"number_format"},{title:"\u64CD\u4F5C",dataIndex:"operation",key:"operation"}],rules:{name_zh:{required:!0},mobile:{required:!0},state:{required:!0}},validateMessages:{required:"${label} is required!",types:{email:"${label} is not a valid email!",number:"${label} is not a valid number!"},number:{range:"${label} must be between ${min} and ${max}"}},labelCol:{style:{width:"150px"}}}},created(){},methods:{createRecord(d){this.modal.data={},this.modal.data.media=[],this.modal.mode="CREATE",this.modal.isOpen=!0},editRecord(d){this.modal.data={...d},this.modal.mode="EDIT",this.modal.title="\u4FEE\u6539",this.modal.isOpen=!0},storeRecord(){this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("admin.certificates.store"),this.modal.data,{onSuccess:d=>{this.modal.isOpen=!1},onError:d=>{console.log(d)}})}).catch(d=>{console.log(d)})},updateRecord(){this.$refs.modalRef.validateFields().then(()=>{this.modal.data._method="PATCH",this.$inertia.post(route("admin.certificates.update",this.modal.data.id),this.modal.data,{onSuccess:d=>{this.modal.isOpen=!1},onError:d=>{console.log(d)}})}).catch(d=>{console.log("error",d)})}}},B={class:"p-8 pt-8"},H={class:"flex pb-2"},M=s("div",{class:"flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"}," \u5C08\u696D\u8A8D\u8B49 ",-1),S={class:"flex-auto w-1/2 text-right"},z={class:"card drop-shadow-md pt-4"},L={key:0,class:"space-x-2"},N={key:0},V=s("svg",{focusable:"false",class:"","data-icon":"delete",width:"1em",height:"1em",fill:"currentColor","aria-hidden":"true",viewBox:"64 64 896 896"},[s("path",{d:"M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"})],-1),D=["src"];function F(d,t,h,P,e,p){const m=i("a-button"),x=i("a-table"),r=i("a-input"),n=i("a-form-item"),y=i("inertia-link"),g=i("upload-outlined"),k=i("a-upload"),C=i("a-textarea"),R=i("a-form"),U=i("a-modal"),w=i("AdminLayout");return c(),f(w,{title:"Dashboard"},{default:o(()=>[s("div",B,[s("div",H,[M,s("div",S,[a(m,{type:"primary",class:"!rounded",onClick:t[0]||(t[0]=l=>p.createRecord())},{default:o(()=>[u("\u65B0\u589E\u5C08\u696D\u8A8D\u8B49")]),_:1})])]),s("div",z,[a(x,{dataSource:h.certificates,columns:e.columns},{bodyCell:o(({column:l,text:j,record:v,index:G})=>[l.dataIndex=="operation"?(c(),b("div",L,[a(m,{onClick:E=>p.editRecord(v)},{default:o(()=>[u("\u4FEE\u6539")]),_:2},1032,["onClick"]),a(m,{onClick:E=>d.deleteRecord(v.id)},{default:o(()=>[u("\u522A\u9664")]),_:2},1032,["onClick"])])):_("",!0)]),_:1},8,["dataSource","columns"])]),a(U,{visible:e.modal.isOpen,"onUpdate:visible":t[12]||(t[12]=l=>e.modal.isOpen=l),title:e.modal.mode=="CREATE"?"\u65B0\u589E":"\u4FEE\u6539",width:"60%"},{footer:o(()=>[e.modal.mode=="EDIT"?(c(),f(m,{key:"Update",type:"primary",onClick:t[10]||(t[10]=l=>p.updateRecord())},{default:o(()=>[u("\u66F4\u65B0")]),_:1})):_("",!0),e.modal.mode=="CREATE"?(c(),f(m,{key:"Store",type:"primary",onClick:t[11]||(t[11]=l=>p.storeRecord())},{default:o(()=>[u("\u65B0\u589E")]),_:1})):_("",!0)]),default:o(()=>[a(R,{ref:"modalRef",model:e.modal.data,name:"Teacher","label-col":{span:8},"wrapper-col":{span:16},autocomplete:"off",rules:e.rules,"validate-messages":e.validateMessages},{default:o(()=>[a(r,{type:"hidden",value:e.modal.data.id,"onUpdate:value":t[1]||(t[1]=l=>e.modal.data.id=l)},null,8,["value"]),a(n,{label:"\u5C08\u696D\u8A8D\u8B49",name:"name"},{default:o(()=>[a(r,{value:e.modal.data.name,"onUpdate:value":t[2]||(t[2]=l=>e.modal.data.name=l)},null,8,["value"])]),_:1}),a(n,{label:"\u8A8D\u8B49\u540D\u7A31",name:"cert_title"},{default:o(()=>[a(r,{value:e.modal.data.cert_title,"onUpdate:value":t[3]||(t[3]=l=>e.modal.data.cert_title=l)},null,8,["value"])]),_:1}),a(n,{label:"\u8A8D\u8B49\u6A5F\u69CB",name:"cert_body"},{default:o(()=>[a(r,{value:e.modal.data.cert_body,"onUpdate:value":t[4]||(t[4]=l=>e.modal.data.cert_body=l)},null,8,["value"])]),_:1}),a(n,{label:"\u6A5F\u69CB\u6A19\u8A8C",name:"cert_logo"},{default:o(()=>[e.modal.data.media.length?(c(),b("div",N,[a(y,{href:d.route("admin.certificate-delete-media",e.modal.data.media[0].id),class:"float-right text-red-500"},{default:o(()=>[V]),_:1},8,["href"]),s("img",{src:"/media/"+e.modal.data.media[0].id+"/"+e.modal.data.media[0].file_name},null,8,D)])):_("",!0),a(k,{"file-list":e.modal.data.cert_logo,"onUpdate:fileList":t[5]||(t[5]=l=>e.modal.data.cert_logo=l),multiple:!1,beforeUpload:()=>!1,"max-count":1,"list-type":"picture"},{default:o(()=>[a(m,null,{default:o(()=>[a(g),u(" upload ")]),_:1})]),_:1},8,["file-list","beforeUpload"])]),_:1}),a(n,{label:"\u8A8D\u8B49\u6A23\u5F0F",name:"cert_template"},{default:o(()=>[a(r,{value:e.modal.data.cert_template,"onUpdate:value":t[6]||(t[6]=l=>e.modal.data.cert_template=l)},null,8,["value"])]),_:1}),a(n,{label:"\u7DE8\u865F\u683C\u5F0F",name:"number_format"},{default:o(()=>[a(r,{value:e.modal.data.number_format,"onUpdate:value":t[7]||(t[7]=l=>e.modal.data.number_format=l)},null,8,["value"])]),_:1}),a(n,{label:"\u7B49\u7D1A\u6A19\u984C",name:"rank_caption"},{default:o(()=>[a(r,{value:e.modal.data.rank_caption,"onUpdate:value":t[8]||(t[8]=l=>e.modal.data.rank_caption=l)},null,8,["value"])]),_:1}),a(n,{label:"\u7C21\u4ECB",name:"description"},{default:o(()=>[a(C,{value:e.modal.data.description,"onUpdate:value":t[9]||(t[9]=l=>e.modal.data.description=l)},null,8,["value"])]),_:1})]),_:1},8,["model","rules","validate-messages"])]),_:1},8,["visible","title"])])]),_:1})}const $=O(q,[["render",F]]);export{$ as default};