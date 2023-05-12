import{_ as A}from"./AdminLayout.cdea8187.js";import{q as z}from"./index.155b5067.js";import{N as E,C as R,D as i,o as v,c as V,w as a,a as s,b as e,d as p,f as m,e as b}from"./app.f3049ff6.js";import{_ as H}from"./_plugin-vue_export-helper.cdc0426e.js";import{U as N}from"./UploadOutlined.4361b0ad.js";import{R as B}from"./RestFilled.9e92e777.js";import"./UserOutlined.8c511291.js";import"./AppstoreOutlined.e3e7ae7c.js";const D={setup(){return{}},components:{AdminLayout:A,UploadOutlined:N,RestFilled:B,quillEditor:z,dayjs:E},props:["course"],data(){return{dateFormat:"YYYY-MM-DD",current:0,quillEditorOption:{placeholder:"core",modules:{}},rules:{name_zh:{required:!0}},validateMessages:{required:"${label} is required!",types:{email:"${label} is not a valid email!",number:"${label} is not a valid number!"},number:{range:"${label} must be between ${min} and ${max}"}}}},created(){Array.isArray(this.course.class_time)||(this.course.class_time=this.course.class_time),this.course.poster_path&&(this.course.poster=[{name:this.course.poster_path.split("/").pop(),url:this.course.poster_url}],console.log(this.course),console.log(this.course.poster_path.split("/").pop()))},mounted(){},computed:{},methods:{updateRecord(){this.$refs.modalRef.validateFields().then(()=>{this.course._method="PATCH",this.$inertia.post(route("admin.courses.update",this.course.id),this.course,{onSuccess:d=>{Array.isArray(this.course.class_time)||(this.course.class_time=this.course.class_time),R.success("\u4FEE\u6539\u6210\u529F"),console.log(d)},onError:d=>{console.log(d)}})}).catch(d=>{console.log("error",d)})}}},L={class:"p-8 pt-8"},M=s("div",{class:"flex pb-2"},[s("div",{class:"flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"}," \u5275\u5EFA\u8AB2\u7A0B ")],-1),Y={class:"card drop-shadow-md pt-4"},T={class:"pb-4"},O={key:0,class:"card bg-white rounded-md p-4"},S=s("div",{class:"text-lg font-bold pb-2"},"\u57FA\u672C\u8CC7\u6599",-1),j={class:"flex-col"},P={class:"flex gap-6"},G={class:"flex-1"},I={class:"flex-1"},J={class:"flex-1"},K={class:"flex gap-6"},Q={class:"flex flex-auto w-1/2 gap-6"},W={class:"flex flex-auto w-1/2 gap-6"},X={class:"flex gap-6"},Z={class:"flex-auto w-1/2"},$={class:"flex-auto w-1/2"},ee={class:"flex gap-6"},te={class:"flex-auto w-1/2"},le={class:"flex-auto w-1/2"},oe={class:"text-right"},ae={key:1,class:"card bg-white p-4 rounded-md"},se=s("div",{class:"text-lg font-bold pb-2"},"\u8AB2\u7A0B\u5167\u5BB9",-1),ue={class:"bg-white"},ne={class:"text-right space-x-4"},ie={key:2,class:"card bg-white p-4 rounded-md"},re=s("div",{class:"text-lg font-bold pb-2"},"\u5C0E\u5E2B\u8CC7\u6599",-1),de={class:"bg-white"},ce={class:"text-right space-x-4"};function me(d,t,o,_e,n,y){const f=i("a-step"),U=i("a-steps"),r=i("a-input"),u=i("a-form-item"),h=i("a-textarea"),g=i("a-date-picker"),_=i("a-input-number"),k=i("a-switch"),w=i("upload-outlined"),c=i("a-button"),C=i("a-upload"),x=i("quill-editor"),F=i("a-form"),q=i("AdminLayout");return v(),V(q,{title:"Dashboard"},{default:a(()=>[s("div",L,[M,s("div",Y,[e(F,{ref:"modalRef",model:o.course,name:"Teacher",layout:"vertical",autocomplete:"off",rules:n.rules,"validate-messages":n.validateMessages},{default:a(()=>[s("div",T,[e(U,{current:n.current,"onUpdate:current":t[0]||(t[0]=l=>n.current=l)},{default:a(()=>[e(f,{title:"\u57FA\u672C\u8CC7\u6599"}),e(f,{title:"\u8AB2\u7A0B\u5167\u5BB9"}),e(f,{title:"\u5C0E\u5E2B\u8CC7\u6599"})]),_:1},8,["current"])]),n.current===0?(v(),p("div",O,[S,s("div",j,[s("div",P,[s("div",G,[e(u,{label:"\u8AB2\u7A0B\u540D\u7A31(\u4E2D\u6587)",name:"name_zh"},{default:a(()=>[e(r,{value:o.course.name_zh,"onUpdate:value":t[1]||(t[1]=l=>o.course.name_zh=l)},null,8,["value"])]),_:1})]),s("div",I,[e(u,{label:"\u8AB2\u7A0B\u540D\u7A31(\u82F1\u6587)",name:"name_en"},{default:a(()=>[e(r,{value:o.course.name_en,"onUpdate:value":t[2]||(t[2]=l=>o.course.name_en=l)},null,8,["value"])]),_:1})]),s("div",J,[e(u,{label:"\u8AB2\u7A0B\u7DE8\u865F",name:"number"},{default:a(()=>[e(r,{value:o.course.number,"onUpdate:value":t[3]||(t[3]=l=>o.course.number=l)},null,8,["value"])]),_:1})])]),e(u,{label:"\u8AB2\u7A0B\u7C21\u4ECB(\u4E2D\u6587)",name:"description_zh"},{default:a(()=>[e(h,{value:o.course.description_zh,"onUpdate:value":t[4]||(t[4]=l=>o.course.description_zh=l)},null,8,["value"])]),_:1}),e(u,{label:"\u8AB2\u7A0B\u7C21\u4ECB(\u82F1\u6587)",name:"description_en"},{default:a(()=>[e(h,{value:o.course.description_en,"onUpdate:value":t[5]||(t[5]=l=>o.course.description_en=l)},null,8,["value"])]),_:1}),s("div",K,[s("div",Q,[e(u,{label:"\u958B\u59CB\u65E5\u671F",name:"start_date"},{default:a(()=>[e(g,{value:o.course.start_date,"onUpdate:value":t[6]||(t[6]=l=>o.course.start_date=l),format:n.dateFormat,valueFormat:n.dateFormat},null,8,["value","format","valueFormat"])]),_:1}),e(u,{label:"\u7D50\u675F\u65E5\u671F",name:"end_date"},{default:a(()=>[e(g,{value:o.course.end_date,"onUpdate:value":t[7]||(t[7]=l=>o.course.end_date=l),format:n.dateFormat,valueFormat:n.dateFormat},null,8,["value","format","valueFormat"])]),_:1}),e(u,{label:"\u4E0A\u8AB2\u6642\u9593",name:"class_time"},{default:a(()=>[e(r,{value:o.course.class_time,"onUpdate:value":t[8]||(t[8]=l=>o.course.class_time=l),format:"HH:mm",valueFormat:"HH:mm"},null,8,["value"])]),_:1}),e(u,{label:"\u6642\u6578",name:"hours"},{default:a(()=>[e(_,{value:o.course.hours,"onUpdate:value":t[9]||(t[9]=l=>o.course.hours=l),min:0},null,8,["value"])]),_:1})]),s("div",W,[e(u,{label:"\u5B78\u8CBB(\u975E\u6703\u54E1)",name:"fee"},{default:a(()=>[e(_,{value:o.course.fee,"onUpdate:value":t[10]||(t[10]=l=>o.course.fee=l),min:0},null,8,["value"])]),_:1}),e(u,{label:"\u5B78\u8CBB(\u6703\u54E1)",name:"fee_member"},{default:a(()=>[e(_,{value:o.course.fee_member,"onUpdate:value":t[11]||(t[11]=l=>o.course.fee_member=l),min:0},null,8,["value"])]),_:1}),e(u,{label:"\u540D\u984D",name:"quota"},{default:a(()=>[e(_,{value:o.course.quota,"onUpdate:value":t[12]||(t[12]=l=>o.course.quota=l),min:1},null,8,["value"])]),_:1}),e(u,{label:"\u8A9E\u8A00",name:"language"},{default:a(()=>[e(r,{value:o.course.language,"onUpdate:value":t[13]||(t[13]=l=>o.course.language=l)},null,8,["value"])]),_:1}),e(u,{label:"\u5C0D\u8C61",name:"target"},{default:a(()=>[e(r,{value:o.course.target,"onUpdate:value":t[14]||(t[14]=l=>o.course.target=l)},null,8,["value"])]),_:1})])]),s("div",X,[s("div",Z,[e(u,{label:"\u5730\u9EDE",name:"location"},{default:a(()=>[e(r,{value:o.course.location,"onUpdate:value":t[15]||(t[15]=l=>o.course.location=l)},null,8,["value"])]),_:1})]),s("div",$,[e(u,{label:"\u8A8D\u53EF\u7BC4\u7587",name:"scope"},{default:a(()=>[e(r,{value:o.course.scope,"onUpdate:value":t[16]||(t[16]=l=>o.course.scope=l)},null,8,["value"])]),_:1})])]),s("div",ee,[s("div",te,[e(u,{label:"\u767C\u4F48",name:"published"},{default:a(()=>[e(k,{checked:o.course.published,"onUpdate:checked":t[17]||(t[17]=l=>o.course.published=l),unCheckedValue:0,checkedValue:1},null,8,["checked"])]),_:1})]),s("div",le,[e(u,{label:"\u55AE\u5F35",name:"poster"},{default:a(()=>[e(C,{"file-list":o.course.poster,"onUpdate:fileList":t[18]||(t[18]=l=>o.course.poster=l),multiple:!1,beforeUpload:()=>!1,"max-count":1,"list-type":"picture"},{default:a(()=>[e(c,null,{default:a(()=>[e(w),m(" \u4E0A\u50B3 ")]),_:1})]),_:1},8,["file-list","beforeUpload"])]),_:1})])])]),s("div",oe,[e(c,{type:"primary",onClick:t[19]||(t[19]=l=>n.current++)},{default:a(()=>[m("\u4E0B\u4E00\u9801")]),_:1})])])):b("",!0),n.current===1?(v(),p("div",ae,[se,e(u,{label:"\u5167\u5BB9",name:"content"},{default:a(()=>[s("div",ue,[e(x,{value:o.course.content,"onUpdate:value":t[20]||(t[20]=l=>o.course.content=l),style:{"min-height":"300px"}},null,8,["value"])])]),_:1}),s("div",ne,[e(c,{onClick:t[21]||(t[21]=l=>n.current--)},{default:a(()=>[m("\u4E0A\u4E00\u9801")]),_:1}),e(c,{type:"primary",onClick:t[22]||(t[22]=l=>n.current++)},{default:a(()=>[m("\u4E0B\u4E00\u9801")]),_:1})])])):b("",!0),n.current===2?(v(),p("div",ie,[re,e(u,{label:"\u5C0E\u5E2B",name:"tutor"},{default:a(()=>[s("div",de,[e(x,{value:o.course.tutor,"onUpdate:value":t[23]||(t[23]=l=>o.course.tutor=l),style:{"min-height":"300px"}},null,8,["value"])])]),_:1}),s("div",ce,[e(c,{onClick:t[24]||(t[24]=l=>n.current--)},{default:a(()=>[m("\u4E0A\u4E00\u9801")]),_:1}),e(c,{key:"Store",type:"primary",onClick:y.updateRecord},{default:a(()=>[m("\u4FEE\u6539")]),_:1},8,["onClick"])])])):b("",!0)]),_:1},8,["model","rules","validate-messages"])])])]),_:1})}const Ue=H(D,[["render",me]]);export{Ue as default};
