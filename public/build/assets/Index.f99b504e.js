import{_ as T}from"./AdminLayout.b1278d3d.js";import{_ as A}from"./_plugin-vue_export-helper.cdc0426e.js";import{U as S}from"./UploadOutlined.e038a453.js";import{R as D}from"./RestFilled.d8a5daa8.js";import{C as h,D as s,o as r,c as v,w as l,a as u,b as a,f as n,d as _,t as k,F as b,e as m}from"./app.8d6b5d0d.js";import"./UserOutlined.74c238c8.js";import"./AppstoreOutlined.5537e5f8.js";const F={components:{AdminLayout:T,UploadOutlined:S,RestFilled:D},props:["forms"],data(){return{modal:{isOpen:!1,data:{},title:"Modal",mode:""},columns:[{title:"\u6A19\u984C",dataIndex:"title"},{title:"\u8AB2\u7A0B\u8868\u683C",dataIndex:"course_id",key:"for_course"},{title:"\u5FC5\u9808\u767B\u9304",dataIndex:"for_account",key:"for_account"},{title:"\u5FC5\u9808\u6703\u54E1",dataIndex:"for_member",key:"for_member"},{title:"\u516C\u958B",dataIndex:"published",key:"published"},{title:"\u64CD\u4F5C",dataIndex:"operation",key:"operation"}],rules:{name:{required:!0},title:{required:!0}},validateMessages:{required:"\u8ACB\u8F93\u5165${label}",types:{email:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u90F5\u7BB1\u683C\u5F0F",number:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u6578\u5B57\u683C\u5F0F"},number:{range:"${label} \u5FC5\u9808\u5728${min}\u548C${max}\u4E4B\u9593"}},labelCol:{style:{width:"150px"}}}},created(){},methods:{createRecord(d){this.modalDataReset(),this.modal.data.media=[],this.modal.mode="CREATE",this.modal.isOpen=!0},editRecord(d){this.modal.data={...d},this.modal.mode="EDIT",this.modal.isOpen=!0},storeRecord(){this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("admin.forms.store"),this.modal.data,{onSuccess:d=>{this.modal.data={},this.modal.isOpen=!1,h.success("\u65B0\u589E\u6210\u529F")},onError:d=>{console.log(d)}})}).catch(d=>{console.log(d)})},updateRecord(){console.log(this.modal.data),this.$refs.modalRef.validateFields().then(()=>{this.modal.data._method="PATCH",this.$inertia.post(route("admin.forms.update",this.modal.data.id),this.modal.data,{onSuccess:d=>{this.modal.isOpen=!1,h.success("\u4FEE\u6539\u6210\u529F")},onError:d=>{console.log(d)}})}).catch(d=>{console.log("error",d)})},modalDataReset(){this.modal.data={name:"",title:"",desctiption:"",for_account:0,for_member:0,published:0}},deleteRecord(d){this.$inertia.delete(route("admin.forms.destroy",{form:d.id}),{onSuccess:e=>{h.success("\u522A\u9664\u6210\u529F")},onError:e=>{h.error(e.message)}})}}},q={class:"md:p-8 pt-8"},B={class:"flex pb-2"},N=u("div",{class:"flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"}," \u8868\u683C\u7BA1\u7406 ",-1),L={class:"flex-auto w-1/2 text-right"},M={class:"container mx-auto pt-5"},H={class:"bg-white relative shadow rounded-lg overflow-x-auto"},P={key:4,class:"space-x-2"};function j(d,e,x,z,o,p){const c=s("a-button"),g=s("inertia-link"),C=s("a-popconfirm"),R=s("a-table"),w=s("a-input"),f=s("a-form-item"),E=s("a-textarea"),y=s("a-switch"),I=s("a-form"),V=s("a-modal"),O=s("AdminLayout");return r(),v(O,{title:"\u8868\u683C\u7BA1\u7406"},{default:l(()=>[u("div",q,[u("div",B,[N,u("div",L,[a(c,{type:"primary",class:"!rounded",onClick:e[0]||(e[0]=t=>p.createRecord())},{default:l(()=>[n("\u65B0\u589E\u8868\u683C")]),_:1})])]),u("div",M,[u("div",H,[a(R,{dataSource:x.forms,columns:o.columns},{bodyCell:l(({column:t,text:G,record:i,index:J})=>[t.key==="published"?(r(),_(b,{key:0},[n(k(i.published===1?"\u516C\u958B":"\u672A\u516C\u958B"),1)],64)):m("",!0),t.key==="for_course"?(r(),_(b,{key:1},[n(k(i.course_id!==null?"\u662F":"\u5426"),1)],64)):m("",!0),t.key==="for_member"?(r(),_(b,{key:2},[n(k(i.for_member===1?"\u662F":"\u5426"),1)],64)):m("",!0),t.key==="for_account"?(r(),_(b,{key:3},[n(k(i.require_login===1?"\u662F":"\u5426"),1)],64)):m("",!0),t.dataIndex=="operation"?(r(),_("div",P,[a(g,{href:d.route("admin.forms.fields.index",{form:i.id}),class:"ant-btn"},{default:l(()=>[n("\u8CC7\u6599\u6B04\u4F4D")]),_:2},1032,["href"]),a(c,{onClick:U=>p.editRecord(i)},{default:l(()=>[n("\u4FEE\u6539")]),_:2},1032,["onClick"]),a(C,{title:"\u662F\u5426\u78BA\u5B9A\u522A\u9664\u9019\u500B\u8868\u683C","ok-text":"\u662F","cancel-text":"\u5426",onConfirm:U=>p.deleteRecord(i)},{default:l(()=>[a(c,null,{default:l(()=>[n("\u522A\u9664")]),_:1})]),_:2},1032,["onConfirm"])])):m("",!0)]),_:1},8,["dataSource","columns"])])]),a(V,{visible:o.modal.isOpen,"onUpdate:visible":e[9]||(e[9]=t=>o.modal.isOpen=t),title:o.modal.mode=="CREATE"?"\u65B0\u589E":"\u4FEE\u6539",width:"60%"},{footer:l(()=>[a(c,{key:"back",onClick:e[6]||(e[6]=t=>o.modal.isOpen=!1)},{default:l(()=>[n("\u53D6\u6D88")]),_:1}),o.modal.mode=="EDIT"?(r(),v(c,{key:"Update",type:"primary",onClick:e[7]||(e[7]=t=>p.updateRecord())},{default:l(()=>[n("\u66F4\u65B0")]),_:1})):m("",!0),o.modal.mode=="CREATE"?(r(),v(c,{key:"Store",type:"primary",onClick:e[8]||(e[8]=t=>p.storeRecord())},{default:l(()=>[n("\u65B0\u589E")]),_:1})):m("",!0)]),default:l(()=>[a(I,{ref:"modalRef",model:o.modal.data,name:"Teacher","label-col":{span:6},"wrapper-col":{span:18},autocomplete:"off",rules:o.rules,"validate-messages":o.validateMessages},{default:l(()=>[a(f,{label:"\u6A19\u984C",name:"title"},{default:l(()=>[a(w,{value:o.modal.data.title,"onUpdate:value":e[1]||(e[1]=t=>o.modal.data.title=t)},null,8,["value"])]),_:1}),a(f,{label:"\u63CF\u8FF0",name:"description"},{default:l(()=>[a(E,{value:o.modal.data.description,"onUpdate:value":e[2]||(e[2]=t=>o.modal.data.description=t)},null,8,["value"])]),_:1}),a(f,{label:"\u5FC5\u9808\u767B\u9304",name:"for_account"},{default:l(()=>[a(y,{checked:o.modal.data.for_account,"onUpdate:checked":e[3]||(e[3]=t=>o.modal.data.for_account=t),unCheckedValue:0,checkedValue:1},null,8,["checked"])]),_:1}),a(f,{label:"\u5FC5\u9808\u6703\u54E1",name:"for_member"},{default:l(()=>[a(y,{checked:o.modal.data.for_member,"onUpdate:checked":e[4]||(e[4]=t=>o.modal.data.for_member=t),unCheckedValue:0,checkedValue:1},null,8,["checked"])]),_:1}),a(f,{label:"\u516C\u958B",name:"published"},{default:l(()=>[a(y,{checked:o.modal.data.published,"onUpdate:checked":e[5]||(e[5]=t=>o.modal.data.published=t),unCheckedValue:0,checkedValue:1},null,8,["checked"])]),_:1})]),_:1},8,["model","rules","validate-messages"])]),_:1},8,["visible","title"])])]),_:1})}const ee=A(F,[["render",j]]);export{ee as default};
