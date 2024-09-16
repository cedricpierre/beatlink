import {ISubscription} from "@/Interfaces/Subscription";
import {User} from "@/types";

export interface IUser extends User {
    name: string
    is_premium: boolean
    is_subscribed: boolean
    is_trial: boolean
    campaigns_count: number
    subscription: ISubscription
    can_create_campaign: boolean
    is_on_grace_period: boolean
    trial_ends_at: Date
}
