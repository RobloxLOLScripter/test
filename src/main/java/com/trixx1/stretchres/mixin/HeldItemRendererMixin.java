package com.trixx1.stretchres.mixin;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.render.item.HeldItemRenderer;
import net.minecraft.client.util.math.MatrixStack;
import net.minecraft.util.Arm;
import org.spongepowered.asm.mixin.Mixin;
import org.spongepowered.asm.mixin.injection.At;
import org.spongepowered.asm.mixin.injection.Inject;
import org.spongepowered.asm.mixin.injection.ModifyVariable;
import org.spongepowered.asm.mixin.injection.callback.CallbackInfo;

@Mixin(HeldItemRenderer.class)
public class HeldItemRendererMixin {
    @Inject(method = "applySwingOffset", at = @At("HEAD"), cancellable = true)
    private void onApplySwingOffset(MatrixStack matrices, Arm arm, float swingProgress, CallbackInfo ci) {
        if (StretchConfig.noHandSwing) {
            ci.cancel();
        }
    }

    @ModifyVariable(method = "applySwingOffset", at = @At("HEAD"), ordinal = 0, argsOnly = true)
    private float modifySwingProgress(float swingProgress) {
        return (float) (swingProgress * StretchConfig.swingSpeed);
    }

    @Inject(method = "renderFirstPersonItem", at = @At("HEAD"))
    private void onRenderFirstPersonItem(CallbackInfo ci) {
        // This is a placeholder for where we might want to start a transformation context
    }

    @Inject(method = "applyEquipOffset", at = @At("HEAD"))
    private void onApplyEquipOffset(MatrixStack matrices, Arm arm, float equipProgress, CallbackInfo ci) {
        float x = (float) StretchConfig.viewmodelX;
        float y = (float) StretchConfig.viewmodelY;
        float z = (float) StretchConfig.viewmodelZ;
        float s = (float) StretchConfig.viewmodelScale;

        if (arm == Arm.LEFT) {
            matrices.translate(-x, y, z);
        } else {
            matrices.translate(x, y, z);
        }

        matrices.scale(s, s, s);
    }
}
