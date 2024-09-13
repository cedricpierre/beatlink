import {ILink} from "@/Interfaces/Link";
import {IPlatform} from "@/Interfaces/Platform";
import {ICampaign} from "@/Interfaces/Campaign";

export interface ILead {
    id: string
    country: string
    user_agent: string
    ip: string
    country_code: string
    referrer: string
    email: string
    name: string
    phone: string
    link: ILink
    platform: IPlatform
    campaign: ICampaign
}
