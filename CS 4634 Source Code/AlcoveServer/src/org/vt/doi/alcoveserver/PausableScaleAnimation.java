package org.vt.doi.alcoveserver;

import android.view.animation.ScaleAnimation;
import android.view.animation.Transformation;

public class PausableScaleAnimation extends ScaleAnimation {
	
	public PausableScaleAnimation(float fromX, float toX, float fromY,
			float toY, int pivotXType, float pivotXValue, int pivotYType,
			float pivotYValue) {
		super(fromX, toX, fromY, toY, pivotXType, pivotXValue, pivotYType, pivotYValue);
	}

	private long mElapsedAtPause = 0;
    private boolean mPaused = false;

	
	
	@Override
    public boolean getTransformation(long currentTime, Transformation t) { 
        if(mPaused && mElapsedAtPause == 0) {
            mElapsedAtPause = currentTime - getStartTime();
        }
        if(mPaused) {
            setStartTime(currentTime - mElapsedAtPause);
        }
        return super.getTransformation(currentTime, t);
    }
	
	public void pause() {
        mElapsedAtPause=0;
        mPaused=true;
    }

    public void resume() {
        mPaused=false;
    }
    
    public boolean isPaused() {
    	return mPaused;
    }
}
