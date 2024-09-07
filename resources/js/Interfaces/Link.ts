import {IPlatform} from "@/Interfaces/Platform";
import {ILead} from "@/Interfaces/Lead";

export interface ILink {
    id: string
    url: string
    platform_id: string,
    platform: IPlatform,
    leads: Array<ILead>
    leads_count: number
}
