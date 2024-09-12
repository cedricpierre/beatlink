import {IPlatform} from "@/Interfaces/Platform";
import {ILead} from "@/Interfaces/Lead";

export interface ILink {
    id: string
    name: string
    is_premium: boolean
    is_subscribed: boolean
    is_trial: boolean
    campaigns_count: number
    subscription: object
}
