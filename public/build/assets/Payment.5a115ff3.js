import{_ as A}from"./AdminLayout.ecf5373d.js";import{_ as M}from"./_plugin-vue_export-helper.cdc0426e.js";import{C as b,D as s,o as m,c as g,w as l,a as p,b as o,f as i,d as y,t as h,F as k,e as u}from"./app.25506e31.js";import"./UserOutlined.59aec3f0.js";import"./AppstoreOutlined.8da2a6ad.js";const z={components:{AdminLayout:A},props:["payments","members","payment_states"],setup(n){const e=n.members.map(r=>r={label:r.name_zh,value:r.id});return e.unshift({label:"\u6240\u6709\u4EBA",value:"0"}),{options:e}},data(){return{columns:[{title:"\u6A19\u984C",dataIndex:"title",key:"title"},{title:"\u6703\u54E1",dataIndex:"member_id",key:"member_id"},{title:"\u6703\u8CBB",dataIndex:"cost",key:"cost"},{title:"\u7E73\u8CBB\u958B\u59CB\u65E5\u671F",dataIndex:"start_date"},{title:"\u7E73\u8CBB\u7D50\u675F\u65E5\u671F",dataIndex:"end_date"},{title:"\u72C0\u614B",dataIndex:"state"},{title:"\u64CD\u4F5C",dataIndex:"operation",key:"operation",width:300}],modal:{isOpen:!1,data:{},title:"Modal",mode:""},dateFormat:"YYYY-MM-DD",pagination:{total:this.payments.total,current:this.payments.current_page,pageSize:this.payments.per_page},filter:{},rules:{title:{required:!0},member_id:{required:!0},cost:{required:!0},start_date:{required:!0},end_date:{required:!0},state:{required:!0}},validateMessages:{required:"\u8ACB\u8F93\u5165${label}",types:{email:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u90F5\u7BB1\u683C\u5F0F",number:"${label} \u4E0D\u662F\u6B63\u78BA\u7684\u6578\u5B57\u683C\u5F0F"},number:{range:"${label} \u5FC5\u9808\u5728${min}\u548C${max}\u4E4B\u9593"}},labelCol:{style:{width:"150px"}}}},mounted(){},methods:{createRecord(){this.modal.data={state:"0"},this.modal.mode="CREATE",this.modal.title="\u65B0\u589E\u7E73\u8CBB\u55AE",this.modal.isOpen=!0},editRecord(n){var e;this.modal.data={...n},this.modal.data.payment_image=[{name:(e=this.modal.data.payment_image_path)==null?void 0:e.split("/").pop(),url:this.modal.data.payment_image_path}],this.modal.mode="EDIT",this.modal.title="\u4FEE\u6539",this.modal.isOpen=!0},storeRecord(){this.$refs.modalRef.validateFields().then(()=>{this.$inertia.post(route("admin.members.payments.store"),this.modal.data,{onSuccess:n=>{this.modal.data={},this.modal.isOpen=!1,b.success("\u65B0\u589E\u6210\u529F")},onError:n=>{b.success("\u65B0\u589E\u6210\u529F"),b.error(n.message)}})}).catch(n=>{console.log(n)})},updateRecord(){console.log(this.modal.data),this.$refs.modalRef.validateFields().then(()=>{this.$inertia.patch("/admin/members/payments/"+this.modal.data.id,this.modal.data,{onSuccess:n=>{this.modal.data={},this.modal.isOpen=!1,b.success("\u4FEE\u6539\u6210\u529F")},onError:n=>{b.warning("\u4FEE\u6539\u5931\u6557")}})}).catch(n=>{console.log("error",n)})},deleteRecord(n){this.$inertia.delete("/admin/members/payments/"+n,{onSuccess:e=>{console.log(e),b.success("\u522A\u9664\u6210\u529F")},onError:e=>{console.log(e)}})},onPaginationChange(n,e,r){console.log(n.current),this.$inertia.get(route("admin.members.payments.index"),{page:n.current,per_page:n.pageSize})}}},B={class:"md:p-8 pt-8"},N={class:"flex pb-2"},V=p("div",{class:"flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"},"\u7E73\u8CBB\u5217\u8868",-1),Y={class:"basis-1/2 text-right"},L={class:"container mx-auto pt-5"},P={class:"bg-white relative shadow rounded-lg overflow-x-auto"},j={key:3,class:"space-x-2"},G=["href"],H=["src"];function J(n,e,r,I,t,_){const c=s("a-button"),E=s("a-popconfirm"),F=s("a-table"),U=s("a-input"),d=s("a-form-item"),x=s("a-select"),C=s("a-input-number"),R=s("a-date-picker"),S=s("a-textarea"),T=s("a-checkbox"),O=s("a-form"),q=s("a-modal"),D=s("AdminLayout");return m(),g(D,{title:"\u7E73\u8CBB\u5217\u8868"},{default:l(()=>[p("div",B,[p("div",N,[V,p("div",Y,[o(c,{onClick:e[0]||(e[0]=a=>_.createRecord()),type:"primary",class:"!rounded"},{default:l(()=>[i("\u65B0\u589E\u7E73\u8CBB\u55AE")]),_:1})])]),p("div",L,[p("div",P,[o(F,{dataSource:r.payments.data,"text-right":"",columns:t.columns,pagination:t.pagination,onChange:_.onPaginationChange,ref:"dataTable"},{bodyCell:l(({column:a,record:f})=>{var w;return[a.dataIndex=="member_id"?(m(),y(k,{key:0},[i(h(r.members.find(v=>v.id==f.member_id).name_zh),1)],64)):u("",!0),a.dataIndex=="cost"?(m(),y(k,{key:1},[i(h(f.cost*((w=f.cost_percentage)!=null?w:100)/100),1)],64)):u("",!0),a.dataIndex=="state"?(m(),y(k,{key:2},[i(h(r.payment_states.find(v=>v.value==f.state).label),1)],64)):u("",!0),a.dataIndex=="operation"?(m(),y("div",j,[o(c,{onClick:v=>_.editRecord(f)},{default:l(()=>[i("\u4FEE\u6539")]),_:2},1032,["onClick"]),o(E,{title:"\u662F\u5426\u78BA\u5B9A\u522A\u9664\u9019\u500B\u7E73\u8CBB\u55AE","ok-text":"\u662F","cancel-text":"\u5426",onConfirm:v=>_.deleteRecord(f.id)},{default:l(()=>[o(c,null,{default:l(()=>[i("\u522A\u9664")]),_:1})]),_:2},1032,["onConfirm"])])):u("",!0)]}),_:1},8,["dataSource","columns","pagination","onChange"])])]),o(q,{visible:t.modal.isOpen,"onUpdate:visible":e[13]||(e[13]=a=>t.modal.isOpen=a),title:t.modal.title,width:"60%"},{footer:l(()=>[o(c,{key:"back",onClick:e[10]||(e[10]=a=>t.modal.isOpen=!1)},{default:l(()=>[i("\u53D6\u6D88")]),_:1}),t.modal.mode=="EDIT"?(m(),g(c,{key:"Update",type:"primary",onClick:e[11]||(e[11]=a=>_.updateRecord())},{default:l(()=>[i("\u78BA\u8A8D")]),_:1})):u("",!0),t.modal.mode=="CREATE"?(m(),g(c,{key:"Store",type:"primary",onClick:e[12]||(e[12]=a=>_.storeRecord())},{default:l(()=>[i("\u65B0\u589E")]),_:1})):u("",!0)]),default:l(()=>[o(O,{ref:"modalRef",model:t.modal.data,name:"Teacher","label-col":{span:8},"wrapper-col":{span:16},autocomplete:"off",rules:t.rules,"validate-messages":t.validateMessages},{default:l(()=>[o(d,{label:"\u6A19\u984C",name:"title"},{default:l(()=>[o(U,{value:t.modal.data.title,"onUpdate:value":e[1]||(e[1]=a=>t.modal.data.title=a)},null,8,["value"])]),_:1}),o(d,{label:"\u6703\u54E1",name:"member_id"},{default:l(()=>[o(x,{value:t.modal.data.member_id,"onUpdate:value":e[2]||(e[2]=a=>t.modal.data.member_id=a),options:I.options},null,8,["value","options"])]),_:1}),o(d,{label:"\u6703\u8CBB",name:"cost"},{default:l(()=>[o(C,{value:t.modal.data.cost,"onUpdate:value":e[3]||(e[3]=a=>t.modal.data.cost=a),min:1},null,8,["value"])]),_:1}),o(d,{label:"\u6703\u8CBB\u6298\u6263(%)",name:"cost_percentage"},{default:l(()=>[o(C,{value:t.modal.data.cost_percentage,"onUpdate:value":e[4]||(e[4]=a=>t.modal.data.cost_percentage=a),max:100},null,8,["value"])]),_:1}),o(d,{label:"\u7E73\u8CBB\u958B\u59CB\u65E5\u671F",name:"start_date"},{default:l(()=>[o(R,{value:t.modal.data.start_date,"onUpdate:value":e[5]||(e[5]=a=>t.modal.data.start_date=a),format:t.dateFormat,valueFormat:t.dateFormat},null,8,["value","format","valueFormat"])]),_:1}),o(d,{label:"\u7E73\u8CBB\u7D50\u675F\u65E5\u671F",name:"end_date"},{default:l(()=>[o(R,{value:t.modal.data.end_date,"onUpdate:value":e[6]||(e[6]=a=>t.modal.data.end_date=a),format:t.dateFormat,valueFormat:t.dateFormat},null,8,["value","format","valueFormat"])]),_:1}),o(d,{label:"\u5099\u8A3B",name:"remark"},{default:l(()=>[o(S,{value:t.modal.data.remark,"onUpdate:value":e[7]||(e[7]=a=>t.modal.data.remark=a)},null,8,["value"])]),_:1}),o(d,{label:"\u72C0\u614B",name:"state"},{default:l(()=>[o(x,{value:t.modal.data.state,"onUpdate:value":e[8]||(e[8]=a=>t.modal.data.state=a),options:r.payment_states},null,8,["value","options"])]),_:1}),t.modal.mode=="EDIT"?(m(),g(d,{key:0,label:"\u6703\u8CBB\u55AE\u76F8\u7247",name:"url"},{default:l(()=>[t.modal.data.url?(m(),y("a",{key:0,href:t.modal.data.url,target:"_blank"},[p("img",{src:t.modal.data.url,class:"h-64 w-64"},null,8,H)],8,G)):u("",!0)]),_:1})):u("",!0),t.modal.mode=="CREATE"?(m(),g(d,{key:1,label:"\u767C\u9001\u96FB\u90F5\u901A\u77E5",name:"send_email"},{default:l(()=>[o(T,{checked:t.modal.data.send_email,"onUpdate:checked":e[9]||(e[9]=a=>t.modal.data.send_email=a)},null,8,["checked"])]),_:1})):u("",!0)]),_:1},8,["model","rules","validate-messages"])]),_:1},8,["visible","title"])])]),_:1})}const $=M(z,[["render",J]]);export{$ as default};