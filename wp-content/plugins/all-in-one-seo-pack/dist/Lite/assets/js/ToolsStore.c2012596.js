import{d as a,h as e,l as o,u,k as c,b as p}from"./index.506b73e8.js";const g=a("ToolsStore",{actions:{clearLog(t){return e.post(o.restUrl("clear-log")).send({log:t}).then(n=>{const s=u();s.aioseo.data.logSizes[t]=n.body.logSize})},emailDebugInfo(t){return e.post(o.restUrl("email-debug-info")).send({email:t})},doTask({action:t,data:n,siteId:s}){const r=u();return e.post(o.restUrl("settings/do-task")).send({action:t,data:n,siteId:s,network:r.aioseo.data.isNetworkAdmin}).then(i=>{if(!(i!=null&&i.statusCode)||i.statusCode===400)return Promise.reject(new Error(`Task ${t} could not be completed.`))})},uploadFile({file:t,filename:n,siteId:s}){return e.post(o.restUrl(`settings/import/${s||""}`)).attach("file",t,n).then(r=>{if(r.body.license&&!s){const l=c();l.license=r.body.license,l.clearLicenseNotices()}const i=p();return i.options=r.body.options,r})},exportSettings(t){return e.post(o.restUrl("settings/export")).send(t)},exportContent(t){return e.post(o.restUrl("settings/export-content")).send(t)},resetSettings({payload:t,siteId:n}){return e.post(o.restUrl("reset-settings")).send({settings:t,siteId:n})},importPlugins(t){return e.post(o.restUrl("settings/import-plugins")).send(t)}}});export{g as u};
