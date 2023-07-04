import{_ as A}from"./AdminLayout.c72fa573.js";import{q as V}from"./index.3c5e6273.js";import{_ as Y}from"./_plugin-vue_export-helper.cdc0426e.js";import{U as B}from"./UploadOutlined.f2b01814.js";import{R as L}from"./RestFilled.a80d11a9.js";import{C as b,D as i,o as m,c as h,w as n,a as r,b as o,f as d,d as v,t as x,F as C,e as _}from"./app.7f364e3c.js";import"./UserOutlined.1f8715dd.js";import"./AppstoreOutlined.bae1f559.js";const M={components:{AdminLayout:A,UploadOutlined:B,RestFilled:L,quillEditor:V},props:["bulletinCategories","bulletins"],data(){return{dateFormat:"YYYY-MM-DD",yearCurrent:2023,yearStart:new Date().getFullYear()+1,yearLength:new Date().getFullYear()-2009+2,loading:!1,modal:{isOpen:!1,data:{published:1},title:"\u516C\u544A",mode:""},pagination:{total:this.bulletins.total,current:this.bulletins.current_page,pageSize:this.bulletins.per_page},filter:{},columns:[{title:"\u6A19\u984C",dataIndex:"title"},{title:"\u65E5\u671F",dataIndex:"date"},{title:"\u5206\u985E",dataIndex:"category"},{title:"\u767C\u4F48",dataIndex:"published",key:"published"},{title:"\u64CD\u4F5C",dataIndex:"operation",key:"operation"}],rules:{title:{required:!0},date:{required:!0},category:{required:!0}},validateMessages:{required:"${label} is required!",types:{email:"${label} is not a valid email!",number:"${label} is not a valid number!"},number:{range:"${label} must be between ${min} and ${max}"}},labelCol:{style:{width:"150px"}}}},created(){},compunted:{pagination(){return{total:this.bulletins.total,current:this.bulletins.current_page,pageSize:this.bulletins.per_page}}},methods:{createRecord(a){this.modal.data={published:1},this.modal.mode="CREATE",this.modal.isOpen=!0},editRecord(a){this.modal.data={...a},this.modal.mode="EDIT",console.log(a),this.modal.isOpen=!0},storeRecord(){this.loading=!0,this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("admin.bulletins.store"),this.modal.data,{preserveState:!1,onSuccess:a=>{this.modal.isOpen=!1,console.log(a),b.success("\u65B0\u589E\u6210\u529F")},onError:a=>{console.log(a)},onFinish:a=>{this.loading=!1}})}).catch(a=>{this.loading=!1,console.log(a)})},updateRecord(){this.$refs.modalRef.validateFields().then(()=>{this.modal.data._method="PATCH",this.$inertia.post(route("admin.bulletins.update",this.modal.data.id),this.modal.data,{preserveState:!1,onSuccess:a=>{this.modal.isOpen=!1,b.success("\u4FEE\u6539\u6210\u529F")},onError:a=>{console.log(a),b.error(a.error)}})}).catch(a=>{console.log("error",a)})},deleteRecord(a){this.$inertia.delete("/admin/bulletins/"+a,{preserveState:!1,onSuccess:t=>{console.log(t)},onError:t=>{alert(t.message)}})},onPaginationChange(a,t,c){this.$inertia.get(route("admin.bulletins.index"),{page:a.current,per_page:a.pageSize})}}},N={class:"p-8 pt-8"},z={class:"flex pb-2"},P=r("div",{class:"flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"}," \u516C\u544A\u7BA1\u7406 ",-1),H={class:"flex-auto w-1/2 text-right"},j={class:"card drop-shadow-md pt-4"},G={key:1,class:"space-x-2"},J=r("div",{style:{"margin-top":"8px"}},"Upload",-1);function K(a,t,c,Q,e,u){const p=i("a-button"),k=i("a-popconfirm"),R=i("a-table"),w=i("a-select"),s=i("a-form-item"),S=i("a-date-picker"),y=i("a-input"),U=i("a-textarea"),E=i("a-switch"),F=i("upload-outlined"),D=i("a-upload"),I=i("a-form"),O=i("a-modal"),T=i("AdminLayout");return m(),h(T,{title:"Dashboard"},{default:n(()=>[r("div",N,[r("div",z,[P,r("div",H,[o(p,{type:"primary",class:"!rounded",onClick:t[0]||(t[0]=l=>u.createRecord())},{default:n(()=>[d("\u65B0\u589E\u516C\u544A")]),_:1})])]),r("div",j,[o(R,{dataSource:c.bulletins.data,columns:e.columns,pagination:e.pagination,onChange:u.onPaginationChange,ref:"dataTable"},{bodyCell:n(({column:l,text:q,record:f,index:W})=>[l.key=="published"?(m(),v(C,{key:0},[d(x(f.published==1?"\u767C\u4F48":"\u975E\u767C\u4F48"),1)],64)):_("",!0),l.dataIndex=="operation"?(m(),v("div",G,[o(p,{onClick:g=>u.editRecord(f)},{default:n(()=>[d("\u4FEE\u6539")]),_:2},1032,["onClick"]),o(k,{title:"\u662F\u5426\u78BA\u5B9A\u522A\u9664\u9019\u500B\u516C\u544A","ok-text":"\u662F","cancel-text":"\u5426",onConfirm:g=>u.deleteRecord(f.id)},{default:n(()=>[o(p,null,{default:n(()=>[d("\u522A\u9664")]),_:1})]),_:2},1032,["onConfirm"])])):l.dataIndex=="category"?(m(),v(C,{key:2},[d(x(c.bulletinCategories.find(g=>g.value==q).label),1)],64)):_("",!0)]),_:1},8,["dataSource","columns","pagination","onChange"])]),o(O,{visible:e.modal.isOpen,"onUpdate:visible":t[10]||(t[10]=l=>e.modal.isOpen=l),title:e.modal.mode=="CREATE"?"\u65B0\u589E":"\u4FEE\u6539",width:"60%"},{footer:n(()=>[e.modal.mode=="EDIT"?(m(),h(p,{loading:e.loading,key:"Update",type:"primary",onClick:t[8]||(t[8]=l=>u.updateRecord())},{default:n(()=>[d("\u4FEE\u6539")]),_:1},8,["loading"])):_("",!0),e.modal.mode=="CREATE"?(m(),h(p,{loading:e.loading,key:"Store",type:"primary",onClick:t[9]||(t[9]=l=>u.storeRecord())},{default:n(()=>[d("\u65B0\u589E")]),_:1},8,["loading"])):_("",!0)]),default:n(()=>[o(I,{ref:"modalRef",model:e.modal.data,"label-col":{span:4},"wrapper-col":{span:20},rules:e.rules,"validate-messages":e.validateMessages},{default:n(()=>[o(s,{label:"\u5206\u985E",name:"category"},{default:n(()=>[o(w,{value:e.modal.data.category,"onUpdate:value":t[1]||(t[1]=l=>e.modal.data.category=l),options:c.bulletinCategories},null,8,["value","options"])]),_:1}),o(s,{label:"\u65E5\u671F",name:"date"},{default:n(()=>[o(S,{value:e.modal.data.date,"onUpdate:value":t[2]||(t[2]=l=>e.modal.data.date=l),format:e.dateFormat,valueFormat:e.dateFormat},null,8,["value","format","valueFormat"])]),_:1}),o(s,{label:"\u6A19\u984C",name:"title"},{default:n(()=>[o(y,{value:e.modal.data.title,"onUpdate:value":t[3]||(t[3]=l=>e.modal.data.title=l)},null,8,["value"])]),_:1}),o(s,{label:"\u63CF\u8FF0",name:"description"},{default:n(()=>[o(y,{value:e.modal.data.description,"onUpdate:value":t[4]||(t[4]=l=>e.modal.data.description=l)},null,8,["value"])]),_:1}),o(s,{label:"\u5167\u5BB9",name:"content"},{default:n(()=>[o(U,{value:e.modal.data.content,"onUpdate:value":t[5]||(t[5]=l=>e.modal.data.content=l)},null,8,["value"])]),_:1}),o(s,{label:"\u767C\u4F48",name:"published"},{default:n(()=>[o(E,{checked:e.modal.data.published,"onUpdate:checked":t[6]||(t[6]=l=>e.modal.data.published=l),unCheckedValue:0,checkedValue:1},null,8,["checked"])]),_:1}),o(s,{label:"\u76F8\u7247",name:"images"},{default:n(()=>[o(D,{"file-list":e.modal.data.images,"onUpdate:fileList":t[7]||(t[7]=l=>e.modal.data.images=l),"list-type":"picture-card",beforeUpload:()=>!1},{default:n(()=>[r("div",null,[o(F),J])]),_:1},8,["file-list","beforeUpload"])]),_:1})]),_:1},8,["model","rules","validate-messages"])]),_:1},8,["visible","title"])])]),_:1})}const ne=Y(M,[["render",K]]);export{ne as default};
